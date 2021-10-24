<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function inclusiveDates() {
        return $this->hasMany(LeaveRequestDate::class);
    }

    public function approvals() {
        return $this->hasMany(LeaveRequestApproval::class);
    }

    // Leave requests for approval for specific role
    public function leaveRequests($role) {
        return LeaveRequest::where('current_action_role', $role)
                            ->where('status', 'pending')
                            ->get();
    }

    public function rejectionDetails() {
        return $this->approvals->where('status', 'rejected');
    }

    public function approvalDetails() {
        return $this->approvals->where('approver', 'simrd')->first();
    }

}
