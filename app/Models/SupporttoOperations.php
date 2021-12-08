<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporttoOperations extends Model
{
    protected $guarded = [];
    protected $fillable = ['s_id', 's_output', 's_success_indicator', 's_actual_accomplishment', 's_remarks'];

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
}
