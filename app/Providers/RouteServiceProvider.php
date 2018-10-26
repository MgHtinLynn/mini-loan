<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $authNamespace = 'App\Http\Controllers\API\Auth';
    protected $apiNameSpace = 'App\Http\Controllers\API';
    protected $backendNameSpace = 'App\Http\Controllers\Backend';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapBackendRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['api', 'cors'])
            ->namespace($this->apiNameSpace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['api', 'cors'])
            ->namespace($this->authNamespace)
            ->group(base_path('routes/auth.php'));
    }

    /**
     *
     * Define the "backend" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapBackendRoutes()
    {
        Route::middleware('backend')
            ->prefix('backend')
            ->namespace($this->backendNameSpace)
            ->group(base_path('routes/backend.php'));
    }
}
