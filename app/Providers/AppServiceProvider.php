<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Dynamically set Mail Configuration
        try {
            $settings = \App\Models\SiteSetting::first();
            if ($settings && $settings->mail_host) {
                config([
                    'mail.mailers.smtp.host' => $settings->mail_host,
                    'mail.mailers.smtp.port' => $settings->mail_port,
                    'mail.mailers.smtp.encryption' => $settings->mail_encryption,
                    'mail.mailers.smtp.username' => $settings->mail_username,
                    'mail.mailers.smtp.password' => $settings->mail_password,
                    'mail.from.address' => $settings->mail_from_address,
                    'mail.from.name' => $settings->mail_from_name,
                ]);
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready
        }
    }
}
