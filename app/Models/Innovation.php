<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Innovation extends Model
{
    protected $guarded = [];
    protected $fillable = ['i_id', 'i_output', 'i_success_indicator', 'i_actual_accomplishment', 'i_remarks'];

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
}
