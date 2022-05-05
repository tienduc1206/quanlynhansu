<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index()
    {
        $users = $this->user->all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        // try {
        //     DB::beginTransaction();
        //     $user = $this->user->create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password)
        //     ])->roles()->attach($request->role_id);
        //     DB::commit();
        //     return redirect()->route('users.index');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error('Message: ' . $e->getMessage() . '--- Line: ' . $e->getLine());
        // }

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required'
        ]);
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ])->roles()->attach($request->role_id);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('roles', 'user', 'rolesOfUser'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . '--- Line: ' . $e->getLine());
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->user->find($id);
            $rolesOfUser = $user->roles;
            $user->roles()->detach($rolesOfUser);
            $user->delete();
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
