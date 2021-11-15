<?php

namespace Vxize\Lavx\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class LavxServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lavx.php', 'lavx');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lavx.php' => config_path('lavx.php'),
        ]);
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lavx');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lavx');

        Validator::extend('alpha_space', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z\s]+$/', $value);
        });
        Validator::extend('alpha_space_dash', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z-\s]+$/', $value);
        });
        Validator::extend('no_alpha_space', function ($attribute, $value) {
            return !preg_match('/^[a-zA-Z\s]+$/', $value);
        });

        // The super admin can skip any $user->can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        // customize verification email
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('lavx::email.verify_email_subject'))
                ->line(__('lavx::email.verify_email_click'))
                ->action(__('lavx::email.verify_email'), $url)
                ->line(__('lavx::email.verify_email_ignore'));
        });
    }
}