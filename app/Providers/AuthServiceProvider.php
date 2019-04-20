<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 管理者のみ許可
        Gate::define('auth-only', function ($staff) {
          return ($staff->is_admin == true);
        });
        // 非管理者のスタッフにも許可
        Gate::define('all-staff', function ($staff) {
          return ($staff == true);
        });
    }
}
