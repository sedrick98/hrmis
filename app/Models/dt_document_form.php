<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class dt_document_form extends Model
{
    protected $primaryKey = "df_id";

    public function dt_documents() {
        return $this->hasMany('App\dt_documents', 'd_type', 'df_id')->where('uid', Auth::user()->id);
    }

    public function user() {
        return $this->belongsTo('App\User', 'added_by_user', 'id')->withDefault([
            'last_name' => 'System',
            'first_name' => 'System'
        ]);
    }

    public function getCtrlNumAttribute() {
        return str_pad($this->d_control_num,4,0, STR_PAD_LEFT);
    }
}