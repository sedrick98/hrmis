<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Dompdf\Dompdf;

use App\Models\User;
use App\Models\LeaveRequest;
use App\Models\LeaveRequestDate;
use App\Models\LeaveRequestApproval;

class LeaveController extends Controller
{
    public function all() {
        return view('leave.all', [
            'pending_leave' => LeaveRequest::where('status', 'pending')->latest()->get(),
            'approved_leave' => LeaveRequest::where('status', 'approved')->latest()->get(),
            'rejected_leave' => LeaveRequest::where('status', 'rejected')->latest()->get(),
        ]);
    }

    public function view(LeaveRequest $leave_request) {
        return view('leave.view', [
            'leave_request' => $leave_request
        ]);
    }

    public function allApprovals() {
        $user = User::find(Auth::id());
        $leave_request = new LeaveRequest;

        return view('leave.all-approval', [
            'for_approvals' => $leave_request->leaveRequests($user->roleName())
        ]);
    }

    public function printLeaveRequest(LeaveRequest $leave_request) {
        // dd($leave_request);

        $variables = [
            'vacation_addl_location',
            'vacation_addl_specify_country',
            'vacation_addl_vacation_reason',
            'sick_leave_addl_type',
            'sick_leave_addl_reason',
            'special_leave_addl_illness',
            'study_leave_addl_reason',
            'other_leave_addl_reason_type',
            'other_leave_addl_reason',
        ];

        $additonalTypes = [];

        foreach($variables as $variable) {
            if ($leave_request[$variable] != null) {
                $additonalTypes[$variable] = $leave_request[$variable];
            }
        }

        // dd($leave_request->approvalDetails());

        // $dompdf = new Dompdf();
        // $dompdf->loadHtml(view('leave.leave-printable', [
        //     'user' => User::find($leave_request->user_id),
        //     'leave' => $leave_request,
        // ]));

        // $dompdf->setPaper('A4', 'portrait');

        // $dompdf->render();

        // $dompdf->stream();

        return view('leave.leave-printable', [
            'user' => User::find($leave_request->user_id),
            'leave' => $leave_request,
        ]);
    }

    public function rejectApproval(LeaveRequestApproval $approval, Request $request) {
        $user = User::find(Auth::id());

        $leave_request = LeaveRequest::find($approval->leave_request_id);
        $leave_request->status = 'rejected';
        $leave_request->save();

        $approval->approver = $user->first_name . $user->last_name;
        $approval->status = 'rejected';
        $approval->approver_id = Auth::id();
        $approval->action_date = Carbon::now()->format('Y-m-d');
        $approval->reason = $request->reason;
        $approval->save();

        return redirect()->route('leave-approval');
    }

    public function approvalUpdate(LeaveRequestApproval $approval, Request $request) {
        $user = User::find(Auth::id());
        $approval->approver = $user->first_name . $user->last_name;
        $approval->status = 'approved';
        $approval->approver_id = Auth::id();
        $approval->action_date = Carbon::now()->format('Y-m-d');
        $approval->reason = $request->reason;

        $leave_request = LeaveRequest::find($approval->leave_request_id);
        switch (strtolower($approval->designated_role)) {
            case 'hr':
                $leave_request->current_action_role = 'ard - fasd';
                break;
            case 'ard - fasd':
                $leave_request->current_action_role = 'ard - division head';
                break;
            case 'ard - division head':
                $leave_request->current_action_role = 'rd';
                break;
            case 'rd':
                $leave_request->current_action_role = 'completed';
                $leave_request->status = 'approved';
                break;
        }

        $approval->save();
        $leave_request->save();

        return redirect()->route('leave-approval');
    }
    
    public function create(Request $request) {
        if ($request->isMethod('get')) {
            return view('leave.create');
        }

        if ($request->isMethod('post')) {
            $leave_dates = explode(',', $request->leave_dates);

            $form_data = $request->all();
            $user_id = Auth::user()->id;

            $form_fields = [
                'leave_type',
                'vacation_addl_location',
                'vacation_addl_specify_country',
                'vacation_addl_vacation_reason',
                'sick_leave_addl_type',
                'sick_leave_addl_reason',
                'special_leave_addl_illness',
                'study_leave_addl_reason',
                'other_leave_addl_reason',
                'other_leave_addl_reason_type',
                'number_of_days',
                'commutation',
            ];

            $data = [];

            foreach($form_fields as $field){
                $data[$field] = $request->has($field) ? $form_data[$field] : null;
            }

            $data['user_id'] = $user_id;

            $leave_request = LeaveRequest::create($data);

            foreach ($leave_dates as $leave_date) {
                LeaveRequestDate::create([
                    'leave_request_id' => $leave_request->id,
                    'date' => $leave_date
                ]);
            }

            LeaveRequestApproval::create([
                'leave_request_id' => $leave_request->id,
                'status' => 'pending',
                'approval_type' => 'HR (Verification)',
                'designated_role' => 'HR',
            ]);

            LeaveRequestApproval::create([
                'leave_request_id' => $leave_request->id,
                'status' => 'pending',
                'approval_type' => 'ARD - FASD (Certification)',
                'designated_role' => 'ARD - FASD',
            ]);

            LeaveRequestApproval::create([
                'leave_request_id' => $leave_request->id,
                'status' => 'pending',
                'approval_type' => 'ARD - Division Head (Certification)',
                'designated_role' => 'ARD - DIVISION HEAD',
            ]);

            LeaveRequestApproval::create([
                'leave_request_id' => $leave_request->id,
                'status' => 'pending',
                'approval_type' => 'RD (Approval)',
                'designated_role' => 'RD',
            ]);

            // return view('leave.create');
            return redirect()->route('leave-view', [
                'leave_request' => $leave_request->id
            ]);
        }
    }
}