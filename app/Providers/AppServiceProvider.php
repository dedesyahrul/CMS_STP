<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Http\Livewire\ApiTokenManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('components.button', 'button');
        Livewire::component('api.api-token-manager', ApiTokenManager::class);
    }
}
