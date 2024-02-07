<?php

namespace DirectsoftRo\LaravelBootstrapAdmin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/admin.php' => config_path('admin.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../routes/admin.php' => base_path('routes/admin.php'),
        ], 'routes');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravel-bootstrap-admin'),
        ], 'assets');

        // Register middleware aliases
        foreach (config('admin.middleware_aliases', []) as $key => $value) {
            app('router')->aliasMiddleware($key, $value);
        }

        $this->registerRoutes();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
    }

    public function register(): void
    {
        if (class_exists(\DirectsoftRo\LaravelBootstrapComponents\Providers\ApplicationServiceProvider::class)) {
            $this->app->register(\DirectsoftRo\LaravelBootstrapComponents\Providers\ApplicationServiceProvider::class);
        }

        if (class_exists(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class)) {
            $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
            $this->app->alias('SEOMeta', \Artesaos\SEOTools\Facades\SEOMeta::class);
            $this->app->alias('OpenGraph', \Artesaos\SEOTools\Facades\OpenGraph::class);
            $this->app->alias('Twitter', \Artesaos\SEOTools\Facades\TwitterCard::class);
            $this->app->alias('JsonLd', \Artesaos\SEOTools\Facades\JsonLd::class);
            $this->app->alias('JsonLdMulti', \Artesaos\SEOTools\Facades\JsonLdMulti::class);
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        $routesPath = base_path('routes/admin.php');
        if (!file_exists($routesPath)) {
            return;
        }

        Route::middleware('web')
            ->as('admin.')
            ->domain(config('admin.domain'))
            ->group(base_path('routes/admin.php'));
    }
}
