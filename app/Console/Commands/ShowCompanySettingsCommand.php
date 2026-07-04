<?php

namespace App\Console\Commands;

use App\Models\CompanySetting;
use Illuminate\Console\Command;

class ShowCompanySettingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:settings {--group=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all company settings or settings by group';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $group = $this->option('group');

        if ($group) {
            $settings = CompanySetting::where('group', $group)->get();
            $this->info("Configuraciones del grupo: {$group}");
        } else {
            $settings = CompanySetting::all();
            $this->info("Todas las configuraciones:");
        }

        if ($settings->isEmpty()) {
            $this->line("No hay configuraciones disponibles.");
            return 0;
        }

        $headers = ['Key', 'Value', 'Type', 'Group', 'Description'];
        $rows = $settings->map(function ($setting) {
            return [
                'key' => $setting->key,
                'value' => substr($setting->value, 0, 50) . (strlen($setting->value) > 50 ? '...' : ''),
                'type' => $setting->type,
                'group' => $setting->group,
                'description' => $setting->description ?? '-',
            ];
        })->toArray();

        $this->table($headers, $rows);

        return 0;
    }
}
