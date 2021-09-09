<?php

namespace App\Traits;

/**
 * Class RoleRelationship.
 */
trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function permissions()
    {
        //return $this->belongsToMany(config('access.role'), config('access.permission_role_table'), 'permission_id', 'role_id');
        //return $this->belongsToMany(config('auth.providers.users.model'), config('access.role_user_table'), 'role_id', 'user_id');
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id')
            ->orderBy('display_name', 'asc');;
    }
}