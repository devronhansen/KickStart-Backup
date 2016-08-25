<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('see-news', function ($user) {
            return $user->news;
        });

        $gate->define('see-offer_detail', function ($user) {
            return $user->offer_detail;
        });

        $gate->define('see-person', function ($user) {
            return $user->person;
        });

        $gate->define('see-time', function ($user) {
            return $user->time;
        });

        $gate->define('see-menu', function ($user) {
            return $user->menu;
        });
    }
}
