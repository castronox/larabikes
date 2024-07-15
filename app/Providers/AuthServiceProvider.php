<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //


        # Gate para autorizar el borrado de una moto, tras la prueba la borraremos
        # puesto que la implementación final la haremos con policies
        Gate::define('borrarMoto', function($user, $bike){
            return $user->id == $bike->user_id;
        });
    }
}
