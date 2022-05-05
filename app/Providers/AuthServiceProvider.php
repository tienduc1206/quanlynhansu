<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\EmployeePolicy;
use App\Services\PermissionGateAndPolicyAccess;
use GMP;
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

        // Define permission
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicyAccess();

        Gate::define('is_admin', function (User $user) {
            $roleOfUser = $user->roles;
            foreach ($roleOfUser as $value) {
                if ($value->name === 'admin') {
                    return true;
                }
            }
            return false;
        });
    }
}
