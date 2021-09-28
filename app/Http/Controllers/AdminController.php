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
        $roles = array();

        foreach (Role::all() as $record) {
            $permissions = array();
            foreach ($record->permissions as $permission) {
                array_push($permissions, Permission::find($permission->permission_id)->name);
            }

            array_push($roles, [
                'id' => $record->id,
                'name' => $record->name,
                'permissions' => $permissions
            ]);
        }

        return view('admin.users', [
                'users' => User::all(),
                'roles' => $roles
            ],
        );
    }

    public function addUser() {
        return view('admin.addUser');
    }

    public function roles() {
        $roles = array();

        foreach (Role::all() as $record) {
            $permissions = array();
            foreach ($record->permissions as $permission) {
                array_push($permissions, Permission::find($permission->permission_id)->name);
            }

            array_push($roles, [
                'id' => $record->id,
                'name' => $record->name,
                'permissions' => $permissions
            ]);
        }

        return view('admin.roles', [
            'roles' => $roles,
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
