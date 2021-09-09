<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class divisions extends Model
{
    //
    protected $primaryKey = 'id';
    public function user() {
        return $this->belongsToMany('App\Models\Access\User\User.php', 'division_id');
    }
}
