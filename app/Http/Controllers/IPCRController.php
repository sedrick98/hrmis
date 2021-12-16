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
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\SupporttoOperations;
use PharIo\Manifest\CopyrightInformation;
use PHPUnit\Framework\Constraint\Operator;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
//use PDF;
//use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;


class IPCRController extends Controller
{

    //-------------views area----------------//
    public function ipcrSubmitted()
    {
        $user = Auth::user()->first_name;
        $submitted = ipcr::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.first_name', $user)
            ->get(['ipcrs.id', 'ipcrs.title', 'ipcrs.created_at', 'employees.last_name', 
            'employees.first_name', 'employees.division', 'ipcrs.status']);

        return view('ipcr.submitted', compact('submitted'));
    }

    public function ipcrCreate(Request $req)
    {
        return view('ipcr.create');
    }

    public function ipcrForm()
    {
        return view('ipcr.form');
    }

    public function ipcrApproval()
    {
        $user = Auth::user()->first_name;
        $submitted = ipcr::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->get(['ipcrs.id', 'ipcrs.title', 'ipcrs.created_at', 
            'employees.last_name', 'employees.first_name', 'employees.division', 'ipcrs.status']);

        return view('ipcr.approval', compact('submitted'));
    }


    //--------------save function for IPCR------------
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
        $save->duration_1 = $request->d_1;
        $save->duration_2 = $request->d_2;
        $save->year = $request->year;
        $save->status = 'pending';
        $save->save();

        //add operations - i
        //$ipcr_id = ipcr::where('employee', $employee_id)->value('id');
        $data = ipcr::latest('id')->first();
        $ipcr_id = $data->id;

        foreach ($request->i_output as $key => $insert) {
            $ops = new Operation();
            $ops->ipcr = $ipcr_id;
            $ops->o_type = 'a';
            $ops->o_output = $request->i_output[$key];
            $ops->o_success_indicator = $request->i_indicator[$key];
            $ops->o_actual_accomplishment = $request->i_accomplish[$key];

            $ops->save();
        }

        //add operations - ii
        foreach ($request->ii_output as $key => $insert) {
            $ops = new Operation();
            $ops->ipcr = $ipcr_id;
            $ops->o_type = 'b';
            $ops->o_output = $request->ii_output[$key];
            $ops->o_success_indicator = $request->ii_indicator[$key];
            $ops->o_actual_accomplishment = $request->ii_accomplish[$key];

            $ops->save();
        }

        //add entry for general administrative services
        foreach ($request->bb_output as $key => $insert) {
            $gen = new GenAdminService();
            $gen->ipcr = $ipcr_id;
            $gen->g_output = $request->bb_output[$key];
            $gen->g_success_indicator = $request->bb_indicator[$key];
            $gen->g_actual_accomplishment = $request->bb_accomplish[$key];

            $gen->save();
        }

        //add entry for support to operations
        foreach ($request->ss_output as $key => $insert) {
            $sup = new SupporttoOperations();
            $sup->ipcr = $ipcr_id;
            $sup->s_output = $request->ss_output[$key];
            $sup->s_success_indicator = $request->ss_indicator[$key];
            $sup->s_actual_accomplishment = $request->ss_accomplish[$key];

            $sup->save();
        }

        //add entry for innovation
        foreach ($request->nn_output as $key => $insert) {
            $inn = new Innovation();
            $inn->ipcr = $ipcr_id;
            $inn->i_output = $request->nn_output[$key];
            $inn->i_success_indicator = $request->nn_indicator[$key];
            $inn->i_actual_accomplishment = $request->nn_accomplish[$key];

            $inn->save();
        }

        return redirect()
            ->route('ipcr-create')
            ->with('success', 'Form successfully saved');
    }


    //--------------display function for view form-----------------
    public function viewData($id)
    {
        $emp_id = IPCR::where('id', $id)->value('employee');

        $form = IPCR::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.emp_id', $emp_id)
            ->get();

        $operation = IPCR::join('operations', 'operations.ipcr', '=', 'ipcrs.id')
            ->where('operations.ipcr', $id)
            ->get();

        $gen = IPCR::join('gen_admin_services', 'gen_admin_services.ipcr', '=', 'ipcrs.id')
            ->where('gen_admin_services.ipcr', $id)
            ->get();

        $support = IPCR::join('supportto_operations', 'supportto_operations.ipcr', '=', 'ipcrs.id')
            ->where('supportto_operations.ipcr', $id)
            ->get();

        $innovation = IPCR::join('innovations', 'innovations.ipcr', '=', 'ipcrs.id')
            ->where('innovations.ipcr', $id)
            ->get();

        $info = IPCR::find($id);

        return view('ipcr.display', compact('info', 'form', 'operation', 'gen', 'support', 'innovation'));
    }


    //--------------display info for edit form---------------
    public function displayData($id)
    {
        $emp_id = IPCR::where('id', $id)->value('employee');

        $form = IPCR::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.emp_id', $emp_id)
            ->get();

        $operation = IPCR::join('operations', 'operations.ipcr', '=', 'ipcrs.id')
            ->where('operations.ipcr', $id)
            ->get();

        $gen = IPCR::join('gen_admin_services', 'gen_admin_services.ipcr', '=', 'ipcrs.id')
            ->where('gen_admin_services.ipcr', $id)
            ->get();

        $support = IPCR::join('supportto_operations', 'supportto_operations.ipcr', '=', 'ipcrs.id')
            ->where('supportto_operations.ipcr', $id)
            ->get();

        $innovation = IPCR::join('innovations', 'innovations.ipcr', '=', 'ipcrs.id')
            ->where('innovations.ipcr', $id)
            ->get();

        $info = IPCR::find($id);

        return view('ipcr.edit', compact('info', 'form', 'operation', 'gen', 'support', 'innovation'));
    }


    //----------display function for rate form----------
    public function rateData($id)
    {
        $emp_id = IPCR::where('id', $id)->value('employee');

        $form = IPCR::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.emp_id', $emp_id)
            ->get();

        $operation = IPCR::join('operations', 'operations.ipcr', '=', 'ipcrs.id')
            ->where('operations.ipcr', $id)
            ->get();

        $gen = IPCR::join('gen_admin_services', 'gen_admin_services.ipcr', '=', 'ipcrs.id')
            ->where('gen_admin_services.ipcr', $id)
            ->get();

        $support = IPCR::join('supportto_operations', 'supportto_operations.ipcr', '=', 'ipcrs.id')
            ->where('supportto_operations.ipcr', $id)
            ->get();

        $innovation = IPCR::join('innovations', 'innovations.ipcr', '=', 'ipcrs.id')
            ->where('innovations.ipcr', $id)
            ->get();

        $info = IPCR::find($id);

        return view('ipcr.rate', compact('info', 'form', 'operation', 'gen', 'support', 'innovation'));
    }

    //------------------update function for IPCR--------------------
    public function updateIPCR(Request $req)
    {
        //save changes in duration
        $duration = ipcr::find($req->ipcr_id);
        $duration->duration_1 = $req->d_1;
        $duration->duration_2 = $req->d_2;
        $duration->year = $req->year;
        $stat = ipcr::where('id', $req->ipcr_id)->value('status');
        if ($stat == 'return' || $stat == 'return - edited') {
            $duration->status = 'return - edited';
        }
        $duration->update();

        foreach ($req->a_id as $item => $v) {
            $data = array(
                'o_output' => $req->i_output[$item],
                'o_success_indicator' => $req->i_indicator[$item],
                'o_actual_accomplishment' => $req->i_accomplish[$item]
            );
            Operation::where('o_id', $req->a_id[$item])
                ->update($data);
        }

        foreach ($req->b_id as $item => $v) {
            $data = array(
                'o_output' => $req->ii_output[$item],
                'o_success_indicator' => $req->ii_indicator[$item],
                'o_actual_accomplishment' => $req->ii_accomplish[$item]
            );
            Operation::where('o_id', $req->b_id[$item])
                ->update($data);
        }

        foreach ($req->g_id as $item => $v) {
            $data = array(
                'g_output' => $req->bb_output[$item],
                'g_success_indicator' => $req->bb_indicator[$item],
                'g_actual_accomplishment' => $req->bb_accomplish[$item]
            );
            GenAdminService::where('g_id', $req->g_id[$item])
                ->update($data);
        }

        foreach ($req->s_id as $item => $v) {
            $data = array(
                's_output' => $req->ss_output[$item],
                's_success_indicator' => $req->ss_indicator[$item],
                's_actual_accomplishment' => $req->ss_accomplish[$item]
            );
            SupporttoOperations::where('s_id', $req->s_id[$item])
                ->update($data);
        }

        foreach ($req->i_id as $item => $v) {
            $data = array(
                'i_output' => $req->nn_output[$item],
                'i_success_indicator' => $req->nn_indicator[$item],
                'i_actual_accomplishment' => $req->nn_accomplish[$item]
            );
            Innovation::where('i_id', $req->i_id[$item])
                ->update($data);
        }


        return redirect()
            ->route('ipcr-submitted')
            ->with('success', 'Form successfully updated');
    }




    //----------------for saving rating on IPCR-------------------
    public function rateIPCR(Request $req)
    {
        //update the status
        $stat = ipcr::find($req->ipcr_id);
        $istat = ipcr::where('id', $req->ipcr_id)->value('status');
        if ($istat == 'return' || $istat == 'return - edited') {
            $stat->status = 'return - edited';
        } else {
            $stat->status = 'rated';
        }

        //$stat->a_1 = Auth::user()->id;
        //$stat->date_1 = $cdate;
        //$stat->comment = $req->comment;
        $stat->update();

        //save rate for operations-1
        foreach ($req->a_id as $item => $v) {
            $total = $req->i_q[$item] + $req->i_e[$item] + $req->i_t[$item];
            $average = $total / 3;
            $data = array(
                'o_quality' => $req->i_q[$item],
                'o_efficiency' => $req->i_e[$item],
                'o_timeliness' => $req->i_t[$item],
                'o_average' => $average,
                'o_remarks' => $req->i_remarks[$item]
            );
            Operation::where('o_id', $req->a_id[$item])
                ->update($data);
        }

        //save rate for operations-2
        foreach ($req->b_id as $item => $v) {
            $total = $req->ii_q[$item] + $req->ii_e[$item] + $req->ii_t[$item];
            $average = $total / 3;
            $data = array(
                'o_quality' => $req->ii_q[$item],
                'o_efficiency' => $req->ii_e[$item],
                'o_timeliness' => $req->ii_t[$item],
                'o_average' => $average,
                'o_remarks' => $req->ii_remarks[$item]
            );
            Operation::where('o_id', $req->b_id[$item])
                ->update($data);
        }

        //------save for genadmin services---------
        foreach ($req->g_id as $item => $v) {
            $total = $req->g_q[$item] + $req->g_e[$item] + $req->g_t[$item];
            $average = $total / 3;
            $data = array(
                'g_quality' => $req->g_q[$item],
                'g_efficiency' => $req->g_e[$item],
                'g_timeliness' => $req->g_t[$item],
                'g_average' => $average,
                'g_remarks' => $req->g_remarks[$item]
            );
            GenAdminService::where('g_id', $req->g_id[$item])
                ->update($data);
        }

        //------save for support to operations---------
        foreach ($req->s_id as $item => $v) {
            $total = $req->s_q[$item] + $req->s_e[$item] + $req->s_t[$item];
            $average = $total / 3;
            $data = array(
                's_quality' => $req->s_q[$item],
                's_efficiency' => $req->s_e[$item],
                's_timeliness' => $req->s_t[$item],
                's_average' => $average,
                's_remarks' => $req->s_remarks[$item]
            );
            SupporttoOperations::where('s_id', $req->s_id[$item])
                ->update($data);
        }

        //------save for innovations---------
        foreach ($req->i_id as $item => $v) {
            $total = $req->nn_q[$item] + $req->nn_e[$item] + $req->nn_t[$item];
            $average = $total / 3;
            $data = array(
                'i_quality' => $req->nn_q[$item],
                'i_efficiency' => $req->nn_e[$item],
                'i_timeliness' => $req->nn_t[$item],
                'i_average' => $average,
                'i_remarks' => $req->nn_remarks[$item]
            );
            Innovation::where('i_id', $req->i_id[$item])
                ->update($data);
        }


        return redirect()
            ->route('ipcr-submitted')
            ->with('success', 'Rating successfully saved');
    }




    //----------display function for review form----------
    public function reviewData($id)
    {
        $emp_id = IPCR::where('id', $id)->value('employee');

        $form = IPCR::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.emp_id', $emp_id)
            ->get();

        $operation = IPCR::join('operations', 'operations.ipcr', '=', 'ipcrs.id')
            ->where('operations.ipcr', $id)
            ->get();

        $gen = IPCR::join('gen_admin_services', 'gen_admin_services.ipcr', '=', 'ipcrs.id')
            ->where('gen_admin_services.ipcr', $id)
            ->get();

        $support = IPCR::join('supportto_operations', 'supportto_operations.ipcr', '=', 'ipcrs.id')
            ->where('supportto_operations.ipcr', $id)
            ->get();

        $innovation = IPCR::join('innovations', 'innovations.ipcr', '=', 'ipcrs.id')
            ->where('innovations.ipcr', $id)
            ->get();

        $info = IPCR::find($id);

        return view('ipcr.review', compact('info', 'form', 'operation', 'gen', 'support', 'innovation'));
    }



    //-------------------approve IPCR form---------------------
    public function approveIPCR(Request $req)
    {
        //get the user role
        $id = RoleUser::where('user_id', Auth::user()->id)->value('role_id');
        $role = Role::where('id', $id)->value('name');
        $cdate = date('m-d-Y');

        switch ($req->input('action')) {
            case 'approve':
                //update the status
                $stat = ipcr::find($req->ipcr_id);
                $stat->status = 'approved:' . $role;
                if ($role == 'ard - section head') {
                    $stat->a_1 = Auth::user()->id;
                    $stat->date_1 = $cdate;
                } elseif ($role == 'ard - division head') {
                    $stat->a_2 = Auth::user()->id;
                    $stat->date_2 = $cdate;
                } elseif ($role == 'rd') {
                    $stat->a_3 = Auth::user()->id;
                }
                $stat->comment = $req->comment;
                $stat->update();
                return redirect()
                    ->route('ipcr-approval')
                    ->with('success', 'Form successfully approved');
                break;

            case 'return':
                $stat = ipcr::find($req->ipcr_id);
                //$stat->status = 'approved:' . $role;
                if ($role == 'ard - section head') {
                    $stat->status = 'return';
                    $stat->a_1 = Auth::user()->id;
                    $stat->date_1 = $cdate;
                } elseif ($role == 'ard - division head') {
                    $stat->status = 'return:' . $role;
                    $stat->a_2 = Auth::user()->id;
                    $stat->date_2 = $cdate;
                } elseif ($role == 'rd') {
                    $stat->status = 'return:' . $role;
                    $stat->a_3 = Auth::user()->id;
                }
                $stat->comment = $req->comment;
                $stat->update();
                return redirect()
                    ->route('ipcr-approval')
                    ->with('success', 'Form was returned');
                break;
        }
    }



    //----------display function for pdf form----------
    public function displayPDF($id)
    {
        $emp_id = IPCR::where('id', $id)->value('employee');

        //get all approver's info
        $sec_id = IPCR::where('id', $id)->value('a_1');
        $sec = User::where('id', $sec_id)->get();

        $div_id = IPCR::where('id', $id)->value('a_2');
        $divhead = User::where('id', $div_id)->get();

        $rd = IPCR::where('id', $id)->value('a_3');
        $rhead = User::where('id', $rd)->get();

        $form = IPCR::join('employees', 'employees.emp_id', '=', 'ipcrs.employee')
            ->where('employees.emp_id', $emp_id)
            ->get();

        $operation = IPCR::join('operations', 'operations.ipcr', '=', 'ipcrs.id')
            ->where('operations.ipcr', $id)
            ->get();

        $gen = IPCR::join('gen_admin_services', 'gen_admin_services.ipcr', '=', 'ipcrs.id')
            ->where('gen_admin_services.ipcr', $id)
            ->get();

        $support = IPCR::join('supportto_operations', 'supportto_operations.ipcr', '=', 'ipcrs.id')
            ->where('supportto_operations.ipcr', $id)
            ->get();

        $innovation = IPCR::join('innovations', 'innovations.ipcr', '=', 'ipcrs.id')
            ->where('innovations.ipcr', $id)
            ->get();

        $info = IPCR::find($id);
        $div = Employee::where('emp_id', $id)->value('division');
        $division = Division::where('abbr', $div)->get();

        //get the entries count
        $oc = Operation::where('ipcr', $id)->count();
        $gc = GenAdminService::where('ipcr', $id)->count();
        $sc = SupporttoOperations::where('ipcr', $id)->count();
        $ic = Innovation::where('ipcr', $id)->count();

        //get the total score per category
        $osum = Operation::where('ipcr', $id)->sum('o_average');
        $gsum = GenAdminService::where('ipcr', $id)->sum('g_average');
        $ssum = SupporttoOperations::where('ipcr', $id)->sum('s_average');
        $isum = Innovation::where('ipcr', $id)->sum('i_average');

        //get the average per category
        $oave = $osum / $oc;
        $gave = $gsum / $gc;
        $save = $ssum / $sc;
        $iave = $isum / $ic;
        $oave = round($oave, 2);
        $gave = round($gave, 2);
        $save = round($save, 2);
        $iave = round($iave, 2);

        //get the final rating
        $of = $oave * 0;
        $gf = $gave * 0.6;
        $sf = $save * 0.2;
        $if = $iave * 0.2;
        $of = round($of, 2);
        $gf = round($gf, 2);
        $sf = round($sf, 2);
        $if = round($if, 2);
        $score = $of + $gf + $sf + $if;
        $score = round($score, 2);
        if ($score == 1 || $score < 1.9) {
            $arating = '1 - Poor';
        } elseif ($score == 2 || $score < 2.9) {
            $arating = '2 - Unsatisfactory';
        } elseif ($score == 3 || $score < 3.9) {
            $arating = '3 - Satisfactory';
        } elseif ($score == 4  || $score < 4.9) {
            $arating = '4 - Very Satisfactory';
        } elseif ($score >= 5) {
            $arating = '5 - Outstanding';
        }



        return view('ipcr.view', compact(
            'info',
            'arating',
            'of',
            'gf',
            'sf',
            'if',
            'score',
            'sec',
            'divhead',
            'rhead',
            'oc',
            'gc',
            'sc',
            'ic',
            'oave',
            'gave',
            'save',
            'iave',
            'division',
            'form',
            'operation',
            'gen',
            'support',
            'innovation'
        ));

        //$pdf = PDF::loadView('myPDF', $data);

        //return $pdf->download('itsolutionstuff.pdf');

        //$details =['info','oc','gc','sc','ic','oave','gave','save','iave', 'division', 'form', 'operation', 'gen', 'support', 'innovation'];
        //view()->share('ipcr.view', compact('info','arating','of','gf','sf','if','score','sec',
        //'divhead','rhead','oc','gc','sc','ic','oave','gave','save','iave', 'division',
        //'form', 'operation', 'gen', 'support', 'innovation'));

        $data = [
            'info' => $info,
            'arating' => $arating,
            'of' => $of,
            'gf' => $gf,
            'sf' => $sf,
            'if' => $if,
            'score' => $score,
            'sec' => $sec,
            'divhead' => $divhead,
            'rhead' => $rhead,
            'oc' => $oc,
            'gc' => $gc,
            'sc' => $sc,
            'ic' => $ic,
            'oave' => $oave,
            'gave' => $gave,
            'save' => $save,
            'iave' => $iave,
            'division' => $division,
            'form' => $form,
            'operation' => $operation,
            'gen' => $gen,
            'support' => $support,
            'innovation' => $innovation
        ];

        //$pdf = PDF::loadView('ipcr.view',$data);
        //$pdf->setpaper('A4','portrait');
        //$pdf->stream();
        //$pdf = app('dompdf.wrapper');   
        //$pdf->loadView('ipcr.view', compact('info','oc','gc','sc','ic','oave','gave','save','iave', 'division', 'form', 'operation', 'gen', 'support', 'innovation'));
        //return $pdf->stream('ipcr.pdf');
        //return $pdf->download('ipcr.pdf')->exit();
    }

    public function deleteIPCR(Request $req, $id)
    {
        Operation::where('ipcr', $id)->delete();

        GenAdminService::where('ipcr', $id)->delete();

        SupporttoOperations::where('ipcr', $id)->delete();

        Innovation::where('ipcr', $id)->delete();

        $precord = IPCR::find($id);
        $precord->delete();

        Employee::where('emp_id', $id)->delete();


        return redirect()
            ->route('ipcr-submitted')
            ->with('success', 'File has been deleted');
    }
}
