<?php

namespace Vxize\Lavx\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LavxServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lavx.php', 'lavx');
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lavx.php' => config_path('lavx.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/../routes/lavx.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'lavx');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lavx');

        // extend validators
        Validator::extend('alpha_space', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z\s]+$/', $value);
        });
        Validator::extend('alpha_space_dash', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z-\s]+$/', $value);
        });
        Validator::extend('no_alpha_space', function ($attribute, $value) {
            return !preg_match('/^[a-zA-Z\s]+$/', $value);
        });
        Validator::extend('chinese', function ($attribute, $value) {
            return preg_match('/^\p{Han}+$/u', $value);
        });

        // The super admin can skip any $user->can()
        Gate::before(function ($user, $ability) {
            $super_admin_user_id = intval(config('lavx.super_admin_user_id'));
            if ($super_admin_user_id && $user->id === $super_admin_user_id) {
                return true;
            }
            return $user->hasRole('super_admin') ? true : null;
        });

        // shouldBeStrict includes:
        // 1. preventLazyLoading
        // 2. preventSilentlyDiscardingAttributes
        // 3. preventAccessingMissingAttributes
        Model::shouldBeStrict(! $this->app->isProduction());

        // customize verification email
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('lavx::email.verify_email_subject'))
                ->line(__('lavx::email.verify_email_click'))
                ->action(__('lavx::email.verify_email'), $url)
                ->line(__('lavx::email.verify_email_ignore'));
        });

        // add paginate to Collections
        // From https://github.com/spatie/laravel-collection-macros/blob/main/src/Macros/Paginate.php
        if (! Collection::hasMacro('paginate')) {            
            Collection::macro('paginate', function (int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = []): LengthAwarePaginator {
                $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
                $results = $this->forPage($page, $perPage)->values();
                $total = $total ?: $this->count();
                $options += [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ];
                return new LengthAwarePaginator($results, $total, $perPage, $page, $options);
            });
        }
    }
}