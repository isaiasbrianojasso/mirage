<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanySetting;

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
        try {
            // Check if the table exists to avoid errors during migrations
            if (Schema::hasTable('company_settings')) {
                $mailSettings = CompanySetting::getByGroup('mail');

                if (!empty($mailSettings)) {
                    $mailer = isset($mailSettings['mail_mailer']) ? $mailSettings['mail_mailer']->value : env('MAIL_MAILER', 'log');
                    
                    Config::set('mail.default', $mailer);
                    
                    if ($mailer === 'smtp') {
                        Config::set('mail.mailers.smtp.host', isset($mailSettings['mail_host']) ? $mailSettings['mail_host']->value : env('MAIL_HOST', '127.0.0.1'));
                        Config::set('mail.mailers.smtp.port', isset($mailSettings['mail_port']) ? $mailSettings['mail_port']->value : env('MAIL_PORT', 2525));
                        Config::set('mail.mailers.smtp.username', isset($mailSettings['mail_username']) ? $mailSettings['mail_username']->value : env('MAIL_USERNAME'));
                        Config::set('mail.mailers.smtp.password', isset($mailSettings['mail_password']) ? $mailSettings['mail_password']->value : env('MAIL_PASSWORD'));
                        Config::set('mail.mailers.smtp.encryption', isset($mailSettings['mail_encryption']) ? $mailSettings['mail_encryption']->value : env('MAIL_ENCRYPTION', 'tls'));
                    }
                    
                    Config::set('mail.from.address', isset($mailSettings['mail_from_address']) ? $mailSettings['mail_from_address']->value : env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                    Config::set('mail.from.name', isset($mailSettings['mail_from_name']) ? $mailSettings['mail_from_name']->value : env('MAIL_FROM_NAME', 'Example'));
                }
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready yet
        }
    }
}
