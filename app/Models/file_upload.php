<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file_upload extends Model
{
    protected $table = 'file_uploads';
    protected $primaryKey = 'fu_id';
    public $timestamps = false;
}
