<?php

namespace App\Providers;

use App\Admin\Contracts\EntitiesOperationsInterface;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach (config('admin.controllers_contracts_binding') as $controller => $service) {
            $this->app->when($controller)
                ->needs(EntitiesOperationsInterface::class)
                ->give($service);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        config(['guards.api.provider' => 'admin_users']);
    }
}
