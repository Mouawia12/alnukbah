<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // When running the application locally with `php artisan serve`, ensure that generated
        // asset URLs honour the current host and port instead of relying on APP_URL which may
        // omit the dev server port. This prevents CSS/JS links from pointing to port 80.
        if (!$this->app->runningInConsole()) {
            $this->app['url']->forceRootUrl(
                $this->app['request']->getSchemeAndHttpHost()
            );
        }
    }
}
