<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $guarded = [];
    protected $fillable = ['o_id', 'o_output', 'o_success_indicator', 'o_actual_accomplishment', 'o_remarks'];

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
    
}
