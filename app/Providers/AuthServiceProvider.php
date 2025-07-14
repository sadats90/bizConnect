<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

         Gate::define('manage-team', function ($user, $team) {
        // Only Owner or Admin can manage team
        return $user->hasRole('Owner') || $user->hasRole('Admin');
    });

    Gate::define('view-project', function ($user, $project) {
        // Member or above can view project
        return $user->hasRole('Owner') || $user->hasRole('Admin') || $user->hasRole('Member');
    });
    }
}
