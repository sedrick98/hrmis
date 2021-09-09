<?php

namespace App\Traits;

/**
 * Class RoleRelationship.
 */
trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        //return $this->belongsToMany(config('auth.providers.users.model'), config('access.role_user_table'), 'role_id', 'user_id');
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }
}