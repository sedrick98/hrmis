<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dt_document_control extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'dt_document_control';

    public function dt_document_routes() {
        return $this->hasMany('App\dt_document_routes', 'd_id');
    }
}
