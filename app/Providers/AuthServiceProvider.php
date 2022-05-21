<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Models\Producto;
use App\Policies\ProductoPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Producto::class => ProductoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('administra', function(User $user){
            return false//?
            //return $user->email == 'admin@proyecto.com';
            //15:30, 03-05
                ? Response::allow()
                : Response::deny('You must be an administrator');
        });
    }
}
