<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\MotherObserver;

use App\Models\Mother;

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
        Mother::observe(MotherObserver::class);
    }
}
