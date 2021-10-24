<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Permission;
use App\Models\ipcr;
use App\Models\Employee;
use App\Models\Operation;
use App\Models\GenAdminService;
use App\Models\Innovation;
use App\Models\SupporttoOperations;
use PharIo\Manifest\CopyrightInformation;

class IPCRController extends Controller
{


    public function ipcrSubmitted()
    {
        $submitted = ipcr::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->get(['ipcrs.ipcr_id','ipcrs.title','employees.last_name','employees.first_name','employees.division','ipcrs.status']);

            return view('ipcr.submitted',compact('submitted'));
    }

    public function ipcrCreate()
    {
        return view('ipcr.create');
    }

    public function ipcrForm()
    {
        return view('ipcr.form');
    }


    public function saveIPCR(Request $request)
    {
        //add employees
        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_name = $request->middle_name;
        $employee->division = $request->division;
        $employee->save();

        //add ipcr entry
        $emp_name = $request->last_name;
        $employee_id = Employee::where('last_name', $emp_name)->value('emp_id');

        $save = new ipcr;
        $save->title = 'ipcr - ' . $emp_name;
        $save->employee = $employee_id;
        $save->status = 'pending';
        $save->save();

        //add operations - i
        $ipcr_id = ipcr::where('employee', $employee_id)->value('ipcr_id');


        foreach ($request->i_output as $key => $insert) {
            $ops = new Operation();
            $ops->ipcr = $ipcr_id;
            $ops->type = 'a';
            $ops->output = $request->i_output[$key];
            $ops->success_indicator = $request->i_indicator[$key];
            $ops->actual_accomplishment = $request->i_accomplish[$key];

            $ops->save();
        }

        foreach ($request->ii_output as $key => $insert) {
            $ops = new Operation();
            $ops->ipcr = $ipcr_id;
            $ops->type = 'b';
            $ops->output = $request->ii_output[$key];
            $ops->success_indicator = $request->ii_indicator[$key];
            $ops->actual_accomplishment = $request->ii_accomplish[$key];

            $ops->save();
        }

        foreach ($request->bb_output as $key => $insert) {
            $gen = new GenAdminService();
            $gen->ipcr = $ipcr_id;
            $gen->output = $request->bb_output[$key];
            $gen->success_indicator = $request->bb_indicator[$key];
            $gen->actual_accomplishment = $request->bb_accomplish[$key];

            $gen->save();
        }

        foreach ($request->ss_output as $key => $insert) {
            $sup = new SupporttoOperations();
            $sup->ipcr = $ipcr_id;
            $sup->output = $request->ss_output[$key];
            $sup->success_indicator = $request->ss_indicator[$key];
            $sup->actual_accomplishment = $request->ss_accomplish[$key];

            $sup->save();
        }

        foreach ($request->nn_output as $key => $insert) {
            $inn = new Innovation();
            $inn->ipcr = $ipcr_id;
            $inn->output = $request->nn_output[$key];
            $inn->success_indicator = $request->nn_indicator[$key];
            $inn->actual_accomplishment = $request->nn_accomplish[$key];

            $inn->save();
        }

        return redirect()
            ->route('ipcr-create');
    }
    
}
