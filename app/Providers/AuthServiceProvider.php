<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Providers\MaternalCardUserProvider;
use App\Models\MaternalCard;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('maternal_cards', function ($app, array $config) {
            return new MaternalCardUserProvider($app['hash'], MaternalCard::class);
        });
    }
}
