<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionRelationship;

class Role extends Model
{
    use PermissionRelationship;
    protected $connection = 'mysql_user';

    protected $table = 'roles';
}
