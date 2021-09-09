<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class dt_document_comment extends Model
{
    use Notifiable;
    // protected $primaryKey = 'd_id';
    public $timestamps = false;

    public function user_comment() {
        return $this->belongsTo('App\User', 'uid_comment', 'id')->withDefault();
    }

    // public function user() {
    //     return $this->hasMany('App\User', 'id', 'a');
    // }
}
