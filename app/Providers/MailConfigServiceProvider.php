<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanySetting;
use App\Mail\Transport\PhpMailerTransport;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Mail::extend('phpmailer', fn (array $config) => new PhpMailerTransport($config));

        try {
            // Check if the table exists to avoid errors during migrations
            if (Schema::hasTable('company_settings')) {
                $mailSettings = CompanySetting::getByGroup('notifications');

                if ($mailSettings->isEmpty()) {
                    $mailSettings = CompanySetting::getByGroup('mail');
                }

                if (!empty($mailSettings)) {
                    $setting = fn (string $key, mixed $default = null) => filled($mailSettings[$key]->value ?? null)
                        ? $mailSettings[$key]->value
                        : $default;

                    $mailer = $setting('mail_mailer', env('MAIL_MAILER', 'log'));
                    
                    Config::set('mail.default', $mailer);
                    
                    if (in_array($mailer, ['smtp', 'phpmailer'], true)) {
                        foreach (['smtp', 'phpmailer'] as $driver) {
                            Config::set("mail.mailers.{$driver}.host", $setting('mail_host', env('MAIL_HOST', '127.0.0.1')));
                            Config::set("mail.mailers.{$driver}.port", $setting('mail_port', env('MAIL_PORT', 2525)));
                            Config::set("mail.mailers.{$driver}.username", $setting('mail_username', env('MAIL_USERNAME')));
                            Config::set("mail.mailers.{$driver}.password", $setting('mail_password', env('MAIL_PASSWORD')));
                            Config::set("mail.mailers.{$driver}.encryption", $setting('mail_encryption', env('MAIL_ENCRYPTION', 'tls')));
                        }
                    }
                    
                    Config::set('mail.from.address', $setting('mail_from_address', env('MAIL_FROM_ADDRESS', 'hello@example.com')));
                    Config::set('mail.from.name', $setting('mail_from_name', env('MAIL_FROM_NAME', 'Example')));
                }
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready yet
        }
    }
}
