<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenAdminService extends Model
{
    protected $guarded = [];
    protected $fillable = ['g_id', 'g_output', 'g_success_indicator', 'g_actual_accomplishment', 'g_remarks'];

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
}
