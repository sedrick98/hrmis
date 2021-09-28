<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function permissions() {
        return $this->hasMany(RolePermission::class);
    }

    public function getPermissionRecord($permission_id) {
        return Permission::find($permission_id);
    }
}
