<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {

        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionsParent'));
    }

    public function store(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->attach($request->perrmission_id);

        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);

        $permissionsChecked = $role->permissions;

        return view('admin.role.edit', compact('permissionsParent', 'role', 'permissionsChecked'));
    }

    public function update($id, Request $request)
    {
        $role = $this->role->find($id);
        $this->role->find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->sync($request->perrmission_id);

        return redirect()->route('roles.index');
    }

    public function delete($id)
    {
        try {
            $role = $this->role->find($id);
            $permissionRole = $role->permissions;
            if ($permissionRole) {
                $role->permissions()->detach($permissionRole);
            }
            $role->delete();
            return response()->json([
                'code' => 200,
                'messege' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'messege' => 'fail'
            ], 500);
        }
    }

   
}
