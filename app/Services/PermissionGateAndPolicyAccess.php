<?php

namespace App\Services;

use App\Policies\DegreePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;

use Illuminate\Support\Facades\Gate;


class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGateEmployee();
        $this->defineGateDepartment();
        $this->defineGateDegree();
        $this->defineGateUser();
        $this->defineGateRole();
    }

    public function defineGateEmployee()
    {
        Gate::define('employee-list', [EmployeePolicy::class, 'viewAny']);
        Gate::define('employee-add', [EmployeePolicy::class, 'create']);
        Gate::define('employee-edit', [EmployeePolicy::class, 'update']);
        Gate::define('employee-delete', [EmployeePolicy::class, 'delete']);
    }

    public function defineGateDepartment()
    {
        Gate::define('department-list', [DepartmentPolicy::class, 'viewAny']);
        Gate::define('department-add', [DepartmentPolicy::class, 'create']);
        Gate::define('department-edit', [DepartmentPolicy::class, 'update']);
        Gate::define('department-delete', [DepartmentPolicy::class, 'delete']);
    }

    public function defineGateDegree()
    {
        Gate::define('degree-list', [DegreePolicy::class, 'viewAny']);
        Gate::define('degree-add', [DegreePolicy::class, 'create']);
        Gate::define('degree-edit', [DegreePolicy::class, 'update']);
        Gate::define('degree-delete', [DegreePolicy::class, 'delete']);
    }

    public function defineGateUser()
    {
        Gate::define('user-list', [UserPolicy::class, 'viewAny']);
        Gate::define('user-add', [UserPolicy::class, 'create']);
        Gate::define('user-edit', [UserPolicy::class, 'update']);
        Gate::define('user-delete', [UserPolicy::class, 'delete']);
    }

    public function defineGateRole()
    {
        Gate::define('role-list', [RolePolicy::class, 'viewAny']);
        Gate::define('role-add', [RolePolicy::class, 'create']);
        Gate::define('role-edit', [RolePolicy::class, 'update']);
        Gate::define('role-delete', [UserPolicy::class, 'delete']);
    }
}
