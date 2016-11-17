<?php

namespace Phoenix\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Phoenix\Models\Unit\Documentation\Category;
use Phoenix\Policies\Unit\Documentation\CategoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        Gate::define('delete-teamspeak', function ($user, $teamspeak) {
            return $user->id == $teamspeak->user_id;
        });
    }
}
