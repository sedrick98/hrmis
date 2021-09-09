<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dt_documents extends Model
{
    use SoftDeletes;
    //
    protected $primaryKey = 'd_id';
    protected $dates = ['deleted_at'];
    //public $timestamps = false;

    public function dt_routes() {
        return $this->hasMany('App\dt_document_routes', 'd_id', 'd_id');
    }

    public function dt_type() {
        //hasMany
        //return $this->hasMany('App\dt_document_form', 'df_id', 'd_type');
        //belongsTo
        return $this->belongsTo('App\dt_document_form', 'd_type', 'df_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'uid', 'id');
    }
    
    public function document_control() {
        return $this->belongsTo('App\dt_document_control', 'd_id', 'd_id');
    }

    public function route_close() {
        
    }
}
