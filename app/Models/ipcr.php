<?php

namespace App\Models;
use App\Models\Employee;
use App\Models\Operation;
use App\Models\GenAdminService;
use App\Models\Innovation;
use App\Models\SupporttoOperations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ipcr extends Model
{
    protected $guarded = [];

    public function operation() {
        return $this->hasMany(Operations::class);
    }

    public function service() {
        return $this->hasMany(GenAdminService::class);
    }

    public function support() {
        return $this->hasMany(SupporttoOperations::class);
    }

    public function innovation() {
        return $this->hasMany(Innovation::class);
    }
}

