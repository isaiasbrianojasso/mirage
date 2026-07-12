<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SystemUpdateController extends Controller
{
    /**
     * Display the update interface.
     */
    public function index()
    {
        return Inertia::render('Admin/SystemUpdate/Index', [
            'currentBranch' => $this->getCurrentBranch(),
            'currentCommit' => $this->getCurrentCommit(),
        ]);
    }

    /**
     * Check for new commits on GitHub.
     */
    public function check(Request $request)
    {
        try {
            $branch = $this->getCurrentBranch();
            $token = $request->input('github_pat');
            $remoteUrl = $this->getAuthenticatedRemoteUrl($token);

            // Fetch latest from origin
            $this->runProcess(['git', 'fetch', $remoteUrl, $branch]);

            // Get log difference
            $output = $this->runProcess(['git', 'log', "HEAD..FETCH_HEAD", '--oneline']);

            $commits = [];
            if (trim($output) !== '') {
                $lines = explode("\n", trim($output));
                foreach ($lines as $line) {
                    if (empty(trim($line))) continue;
                    
                    // Format is: hash message
                    $parts = explode(' ', $line, 2);
                    if (count($parts) === 2) {
                        $commits[] = [
                            'hash' => $parts[0],
                            'message' => $parts[1]
                        ];
                    }
                }
            }

            return response()->json([
                'success' => true,
                'has_updates' => count($commits) > 0,
                'commits' => $commits,
            ]);

        } catch (\Exception $e) {
            Log::error('Update Check Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar actualizaciones: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Apply the update.
     */
    public function apply(Request $request)
    {
        // I (Isolation): Ensure only one update can run at a time
        $lock = Cache::lock('system-update', 300); // 5 minutes lock
        if (!$lock->get()) {
            return response()->json(['success' => false, 'message' => 'Ya hay una actualización en proceso.'], 423);
        }

        set_time_limit(300); // 5 minutes max

        $runNpmBuild = $request->boolean('run_npm_build', false);
        $branch = $this->getCurrentBranch();
        
        $outputLog = [];
        $originalCommit = $this->getCurrentCommit();
        
        // C (Consistency): Put app in maintenance mode to prevent inconsistent states
        try { Artisan::call('down', ['--secret' => 'updating']); } catch (\Exception $e) {}
        $outputLog[] = "[Consistencia] Aplicación en modo mantenimiento.";

        try {
            // A (Atomicity): Prepare for potential rollback
            $outputLog[] = "[Atomicidad] Registrando commit original: {$originalCommit} para posible rollback.";

            $token = $request->input('github_pat');
            $remoteUrl = $this->getAuthenticatedRemoteUrl($token);

            if ($token) {
                $outputLog[] = "Usando token personal (PAT) temporal para la autenticación.";
            }

            // 1. Git Pull
            $outputLog[] = "Ejecutando git pull...";
            $outputLog[] = $this->runProcess(['git', 'pull', $remoteUrl, $branch]);

            // 2. Composer Install
            $outputLog[] = "Ejecutando composer install...";
            $outputLog[] = $this->runProcess(['composer', 'install', '--no-interaction', '--prefer-dist', '--optimize-autoloader']);

            // 3. Migrations
            $outputLog[] = "Ejecutando migraciones...";
            Artisan::call('migrate', ['--force' => true]);
            $outputLog[] = Artisan::output();

            // 4. NPM Build (if requested)
            if ($runNpmBuild) {
                $outputLog[] = "Ejecutando npm install & npm run build...";
                $outputLog[] = $this->runProcess(['npm', 'install']);
                $outputLog[] = $this->runProcess(['npm', 'run', 'build']);
            }

            // 5. Optimize Clear
            $outputLog[] = "Limpiando caché...";
            Artisan::call('optimize:clear');
            $outputLog[] = Artisan::output();

            // D (Durability): Update successful
            $outputLog[] = "[Durabilidad] Todos los comandos finalizaron con éxito. Nueva versión persistida.";

            try { Artisan::call('up'); } catch (\Exception $ignore) {}
            $lock->release();

            return response()->json([
                'success' => true,
                'message' => 'Actualización aplicada correctamente (ACID).',
                'log' => implode("\n", $outputLog)
            ]);

        } catch (\Exception $e) {
            // ROLLBACK (Atomicity enforcement)
            $outputLog[] = "=========================================";
            $outputLog[] = "ERROR DETECTADO: " . $e->getMessage();
            $outputLog[] = "[Atomicidad] INICIANDO ROLLBACK (Deshaciendo cambios)...";

            try {
                // Rollback files
                $outputLog[] = $this->runProcess(['git', 'reset', '--hard', $originalCommit]);
                
                // Rollback vendor if composer failed midway (or was updated and something else failed)
                $outputLog[] = $this->runProcess(['composer', 'install', '--no-interaction', '--prefer-dist', '--optimize-autoloader']);
                
                // Rebuild assets if they were modified
                if ($runNpmBuild) {
                    $outputLog[] = $this->runProcess(['npm', 'run', 'build']);
                }

                $outputLog[] = "[Atomicidad] Rollback completado con éxito. El sistema volvió a su estado original.";
            } catch (\Exception $rollbackError) {
                $outputLog[] = "FATAL: Error durante el rollback: " . $rollbackError->getMessage();
            }

            try { Artisan::call('up'); } catch (\Exception $ignore) {}
            $lock->release();
            
            Log::error('Update Apply Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al aplicar actualización. Se ha ejecutado el rollback.',
                'log' => implode("\n", $outputLog)
            ], 500);
        }
    }

    private function runProcess(array $command)
    {
        $process = new Process($command);
        $process->setWorkingDirectory(base_path());
        $process->setTimeout(180);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    private function getCurrentBranch()
    {
        try {
            return trim($this->runProcess(['git', 'rev-parse', '--abbrev-ref', 'HEAD']));
        } catch (\Exception $e) {
            return 'main';
        }
    }

    private function getCurrentCommit()
    {
        try {
            return trim($this->runProcess(['git', 'rev-parse', '--short', 'HEAD']));
        } catch (\Exception $e) {
            return 'unknown';
        }
    }

    private function getAuthenticatedRemoteUrl($token)
    {
        if (empty($token)) {
            return 'origin';
        }
        
        try {
            $url = trim($this->runProcess(['git', 'config', '--get', 'remote.origin.url']));
            
            // Handle https://github.com/user/repo.git
            if (str_starts_with($url, 'https://')) {
                return str_replace('https://', 'https://' . $token . '@', $url);
            }
            
            // Handle git@github.com:user/repo.git
            if (str_starts_with($url, 'git@github.com:')) {
                $path = substr($url, 15); // Extracts user/repo.git
                return 'https://' . $token . '@github.com/' . $path;
            }

            return $url;
        } catch (\Exception $e) {
            return 'origin';
        }
    }
}
