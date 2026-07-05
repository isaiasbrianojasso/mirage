<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class AdminEmailTemplateController extends Controller
{
    /**
     * Muestra la lista de plantillas de correo.
     */
    public function index()
    {
        $emailsPath = resource_path('views/emails');
        $files = [];

        if (File::exists($emailsPath)) {
            $allFiles = File::files($emailsPath);
            foreach ($allFiles as $file) {
                if ($file->getExtension() === 'php') { // .blade.php
                    $files[] = [
                        'name' => str_replace('.blade.php', '', $file->getFilename()),
                        'filename' => $file->getFilename(),
                        'size' => $file->getSize(),
                        'last_modified' => date('Y-m-d H:i:s', $file->getMTime()),
                    ];
                }
            }
        }

        return Inertia::render('Admin/EmailTemplates/Index', [
            'templates' => $files
        ]);
    }

    /**
     * Muestra el formulario para editar una plantilla.
     */
    public function edit($name)
    {
        // Seguridad para evitar path traversal
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
        
        $filePath = resource_path("views/emails/{$name}.blade.php");

        if (!File::exists($filePath)) {
            return redirect()->route('admin.email-templates.index')->with('error', 'Plantilla no encontrada.');
        }

        $content = File::get($filePath);

        return Inertia::render('Admin/EmailTemplates/Edit', [
            'templateName' => $name,
            'content' => $content
        ]);
    }

    /**
     * Guarda los cambios en la plantilla.
     */
    public function update(Request $request, $name)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Seguridad
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
        $filePath = resource_path("views/emails/{$name}.blade.php");

        if (!File::exists($filePath)) {
            return redirect()->route('admin.email-templates.index')->with('error', 'Plantilla no encontrada.');
        }

        try {
            File::put($filePath, $request->input('content'));
            return redirect()->route('admin.email-templates.index')->with('success', 'Plantilla actualizada exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al guardar la plantilla: ' . $e->getMessage());
        }
    }
}
