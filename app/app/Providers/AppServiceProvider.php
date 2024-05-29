<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Http\Livewire\ApiTokenManager;

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
        Livewire::component('api.api-token-manager', ApiTokenManager::class);
    }
}
