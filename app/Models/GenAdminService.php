<?php

namespace App\Models;

use App\Models\ipcr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenAdminService extends Model
{
    use HasFactory;

    public function ipcr()
    {
        return $this->belongsTo(IPCR::class);
    }
}
