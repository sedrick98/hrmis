<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function users() {
        return view('admin.users', [
                'users' => User::all(),
                'roles' => Role::all()
            ],
        );
    }

    public function addUser() {
        return view('admin.addUser');
    }

    public function roles() {
        return view('admin.roles', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function addRole(Request $request) {
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->save();

        $permissions = $request->permissions;
        foreach ($permissions as $permission) {
            RolePermission::create([
                'permission_id' => $permission,
                'role_id' => $role->id
            ]);
        }

        return redirect()->route('admin-roles')
                ->with('success_role_added', 'New Role Added');
    }

    public function permissions() {
        return view('admin.permissions');
    }
}
