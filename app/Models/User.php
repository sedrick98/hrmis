<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\RoleRelationship;

class User extends Authenticatable
{
    use Notifiable, RoleRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->hasOne(RoleUser::class);
    }

    public function roleName() {
        $role_id = $this->role->role_id;
        return Role::find($role_id)->name;
    }

    public function roles() {
        return $this->hasMany(RoleUser::class);
    }

}