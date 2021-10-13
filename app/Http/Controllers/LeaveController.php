<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class LeaveController extends Controller
{
    public function create(Request $request) {
        if ($request->isMethod('get')) {
            return view('leave.create');
        }

        if ($request->isMethod('post')) {
            $form_data = $request->all();

            $user_id = Auth::user()->id;

            LeaveRequest::create([
                // 'position'                              =>      $request->position ? $request->has('position') : null,
                // 'salary'                                =>      $request->salary ? $request->has('salary') : null,

                'user_id' => $user_id,

                'leave_type'                            =>       $request->has('leave_type') ? $form_data['leave_type'] : null,

                'vacation_addl_location'                =>       $request->has('vacation_addl_location') ? $form_data['vacation_addl_location'] : null,
                'vacation_addl_specify_country'         =>       $request->has('vacation_addl_specify_country') ? $form_data['vacation_addl_specify_country'] : null,
                'vacation_addl_vacation_reason'         =>       $request->has('vacation_addl_vacation_reason') ? $form_data['vacation_addl_vacation_reason'] : null,

                'sick_leave_addl_type'                  =>       $request->has('sick_leave_addl_type') ? $form_data['sick_leave_addl_type'] : null,
                'sick_leave_addl_reason'                =>       $request->has('sick_leave_addl_reason') ? $form_data['sick_leave_addl_reason'] : null,

                'special_leave_addl_illness'            =>       $request->has('special_leave_addl_illness') ? $form_data['special_leave_addl_illness'] : null,

                'study_leave_addl_reason'               =>       $request->has('study_leave_addl_reason') ? $form_data['study_leave_addl_reason'] : null,

                'other_leave_addl_reason'               =>       $request->has('other_leave_addl_reason') ? $form_data['other_leave_addl_reason'] : null,
                'other_leave_addl_reason_type'          =>       $request->has('other_leave_addl_reason_type') ? $form_data['other_leave_addl_reason_type'] : null,

                'start_date'                            =>       $request->has('start_date') ? $form_data['start_date'] : null,
                'end_date'                              =>       $request->has('end_date') ? $form_data['end_date'] : null,
                'number_of_days'                        =>       $request->has('number_of_days') ? $form_data['number_of_days'] : null,
                'commutation'                           =>       $request->has('commutation') ? $form_data['commutation'] : null,
            ]);

            return view('leave.create');
        }
    }
}



// LeaveRequest::create([
//     'user_id' => 2,
//     'leave_type'  => 'something',
//     'start_date' => '2020-05-12',
//     'end_date' => '2020-05-12',
//     'number_of_days' => 10,
//     'commutation' => 'Something',
// ]);

// position
// salary

// leave_type

// vacation_addl_location
// vacation_addl_specify_country
// vacation_addl_vacation_reason

// sick_leave_addl_type
// sick_leave_addl_reason

// special_leave_addl_illness

// study_leave_addl_reason

// other_leave_addl_reason
// other_leave_addl_reason_type

// start_date
// end_date
// number_of_days
// commutation