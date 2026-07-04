<?php

namespace App\Console\Commands;

use App\Models\CompanySetting;
use Illuminate\Console\Command;

class UpdateCompanySettingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:setting {key} {value} {--type=string} {--group=general}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update or create a company setting';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        $value = $this->argument('value');
        $type = $this->option('type');
        $group = $this->option('group');

        try {
            $setting = CompanySetting::set($key, $value, $type, $group);

            $this->info("✓ Configuración actualizada:");
            $this->line("  Key: {$setting->key}");
            $this->line("  Value: {$setting->value}");
            $this->line("  Type: {$setting->type}");
            $this->line("  Group: {$setting->group}");
        } catch (\Exception $e) {
            $this->error("✗ Error: {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
