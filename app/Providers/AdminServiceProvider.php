<?php

namespace App\Providers;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Support\ServiceProvider;

/**
 * Class AdminServiceProvider
 * @package App\Providers
 */
class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->prepareControllerBindings();
        $this->prepareControllerRequestBindings();
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

    private function prepareControllerBindings(): void
    {
        foreach (config('admin.controllers_contracts_operations_binding') as $controller => $service) {
            $this->app->when($controller)
                ->needs(EntitiesOperationsContractor::class)
                ->give($service);
        }

        foreach (config('admin.controllers_contracts_data_binding') as $controller => $service) {
            $this->app->when($controller)
                ->needs(EntitiesDataContractor::class)
                ->give($service);
        }
    }

    private function prepareControllerRequestBindings(): void
    {
        $parts = $this->app->request->segments();

        if (empty($parts[1])) {
            return;
        }

        foreach (config('admin.controllers_request_binding') as $part => $request) {
            if ($parts[1] === $part) {
                $this->app->bind(EntityRequestOperationsContractor::class, $request);
            }
        }
    }
}
