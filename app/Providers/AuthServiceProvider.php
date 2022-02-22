<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\ImagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Image::class => ImagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function (User $user) {
            return str($user->role)->lower() == 'admin';
        });

        Gate::define('is-creator', function (User $user) {
            return str($user->role)->lower() == 'creator';
        });

        Gate::define('is-guest', function (User $user) {
            return str($user->role)->lower() == 'guest';
        });
    }
}
