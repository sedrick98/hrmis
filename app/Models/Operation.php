<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $guarded = [];
    protected $fillable = ['ipcr', 'output', 'success_indicator', 'actual_accomplishment'];

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
}
