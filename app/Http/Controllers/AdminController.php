<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Division;
use App\Models\Permission;
use App\Models\RolePermission;
use PharIo\Manifest\CopyrightInformation;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
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

        $roles_dict = Role::all();

        return view(
            'admin.users',
            [
                'users' => User::all(),
                'roles' => $roles,
                'roles_dict' => $roles_dict
            ],
        );
    }

    public function addUser()
    {
        return view('admin.addUser', ['roles' => Role::all()], ['div' => Division::all()]);
    }

    public function roles()
    {
        return view('admin.roles', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function addRole(Request $request)
    {
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

    public function permissions()
    {
        return view('admin.permissions', [
            'permissions' => Permission::all()
        ]);
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->name = $request->name;
        $role->save();

        // Delete all role_permissions
        $permission_record = RolePermission::where('role_id', $request->role_id)->delete();

        // Re-add all role_permissions
        $permissions = $request->permissions;
        foreach ($permissions as $permission) {
            RolePermission::create([
                'permission_id' => $permission,
                'role_id' => $role->id
            ]);
        }

        return redirect()->route('admin-roles');
    }

    public function addPermission(Request $request)
    {
        $name = $request->name;

        Permission::create([
            'name' => $name
        ]);

        return redirect()
            ->route('admin-permissions')
            ->with('create_success', 'Permission Added');
    }

    public function updatePermission(Request $request)
    {
        error_log($request);
        $permission_id = $request->permission_id;
        $permission = Permission::find($permission_id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()
            ->route('admin-permissions')
            ->with('update_success', 'Permission Name Updated');
    }
}
