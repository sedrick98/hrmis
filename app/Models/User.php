<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\RoleRelationship;

class User extends Authenticatable
{
    use Notifiable, RoleRelationship;
    protected $connection = 'mysql_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function division() {
        return $this->hasOne('App\divisions', 'id', 'division_id');
    }

    public function hasRole($nameOrId) {
        
        foreach ($this->roles as $role) {
            //See if role has all permissions
            if ($role->all) {
                return true;
            }

            //First check to see if it's an ID
            if (is_numeric($nameOrId)) {
                if ($role->id == $nameOrId) {
                    return true;
                }
            }
            //Otherwise check by name
            if ($role->name == $nameOrId) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($nameOrId) {
        foreach ($this->roles as $r) {
            //See if role has all permissions
            if ($r->all) {
                return true;
            }

            // Validate against the Permission table
            foreach ($r->permissions as $perm) {

                // First check to see if it's an ID
                if (is_numeric($nameOrId)) {
                    if ($perm->id == $nameOrId) {
                        return true;
                    }
                }

                // Otherwise check by name
                if ($perm->name == $nameOrId) {
                    return true;
                }
            }
        }
        return false;
    }
    // public function role() {
    //     return $this->hasMany('App\Role', 'id', 'id');
    // }
}