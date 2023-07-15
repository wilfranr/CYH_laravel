<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        //gate para super admin y admin
        Gate::define('users.index', function ($user) {
            return $user->hasRole('superadmin') || $user->hasRole('admin');
        });
        Gate::define('users.destroy', function ($user) {
            return $user->hasRole('superadmin');
        });
        Gate::define('acceso-lista-padre', function ($user) {
            return $user->hasRole('superadmin');
        });
        Gate::define('manage-users', function ($user) {
            return $user->hasRole('superadmin');
        });
        Gate::define('access-register', function ($user) {
            return $user->hasRole('superadmin') || $user->hasRole('admin');
        });

        
    }
}
