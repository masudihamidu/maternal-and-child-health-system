<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\MotherObserver;

use App\Models\Mother;

use App\Models\Disease;

use App\Models\Immunity;

use App\Observers\DiseaseObserver;

use App\Observers\ImmunityObserver;

use App\Models\PregnancySummary;

use App\Observers\PregnancySummaryObserver;


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
        Disease::observe(DiseaseObserver::class);
        Immunity::observe(ImmunityObserver::class);
        PregnancySummary::observe(PregnancySummaryObserver::class);

    }
}
