<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create_esig() {
        //dd(public_path());
         $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
                 ->where('view_account', 1)
                 ->where('status', 1)
				 //->where('img_path', 'upload/employee/user.png')
				 //->whereNull('dtr_img')
				 //->whereNull('e_signature')
                 ->orderBy('last_name')
                 ->get();

        //$users = User::select('first_name', 'last_name', 'middle_name', 'extname','contact_num')->get()->toArray(0);
        
        // $users = DB::table('users')
        //         ->leftjoin('users_personal_informations', 'users_personal_informations.user_id', '=', 'users.id')
        //         ->select('first_name', 'last_name', 'middle_name', 'extname','contact_num','dob', 'pob', 'sex', 'c_status', 'height', 'weight', 'b_type', 
        //         'gsis', 'pagibig', 'phealth', 'sss', 'tin', 'emp_no', 'citizenship', 'citizenship_details', 'resident_house_block_lotno', 'resident_street', 
        //         'resident_subdivision_village', 'resident_barangay', 'resident_city_municipality', 'resident_province', 'resident_zipcode', 'permanent_house_block_lotno', 
        //         'permanent_street', 'permanent_subdivision_village', 'permanent_barangay', 'permanent_city_municipality', 'permanent_province', 'permanent_zipcode', 
        //         'tphone_no', 'mobile_no', 'email_add', 'spouse_sname', 'spouse_fname', 'spouse_mname', 'spouse_ext_name', 'spouse_occupation', 'business_name', 
        //         'business_address', 'business_tphone_no', 'father_sname', 'father_fname', 'father_mname', 'father_ext_name', 'mother_maiden_name', 'mother_sname', 
        //         'mother_fname', 'mother_mname', 'w_third_degree', 'w_fourth_degree', 'w_fourth_degree_details', 'administrative_offense', 'administrative_details', 
        //         'criminally_charged', 'date_filed', 'status_of_case', 'convicted_crime', 'convicted_details', 'separated_from_service', 'separated_from_service_details', 
        //         'candidate_national_local', 'candidate_national_local_details', 'resigned_gov_service', 'resigned_gov_service_details', 'acquired_status', 
        //         'acquired_status_details', 'indigenous_group', 'indigenous_group_details', 'person_disability', 'person_disability_details', 'solo_parent', 
        //         'solo_parent_details')
        //         ->where('view_account', 1)
        //         ->where('status','1')
        //         ->where('users.id', 11)
        //         ->get()
        //         ->toArray();

        //$profile = $this->profile(11);
        //dd($profile[0]->profile);
        /*$to_hash = '';
        $hash_pds = array();
        $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"), 'id')
                    ->where('view_account', 1)
                    ->where('status','1')        
                    ->orderBy('last_name')
                    ->get();
//dd($users);
        foreach ($users as $user) {
            $profile     = $this->profile($user->id);
            $ebground    = $this->ebground($user->id);
            $eligilities = $this->eligilities($user->id);
            $references  = $this->references(11);
            $childrens   = $this->childrens($user->id);
            $train_dev   = $this->train_dev($user->id);
            $voluntary   = $this->voluntary($user->id);
            $work_exp    = $this->work_exp($user->id);
            $other_info  = $this->other_info($user->id);
            $to_hash     = $profile.$ebground.$eligilities.$references.$childrens.$train_dev.$voluntary.$work_exp.$other_info;
            //$hash_pds[$user->id.$user->name]    = hash('sha256',$to_hash);
            $hash_pds[$user->name]    = hash('sha256',$to_hash);
        }

        return view('user.create_esig', compact('users', 'hash_pds'));*/
        // $profile     = $this->profile();
        // $ebground    = $this->ebground();
        // $eligilities = $this->eligilities();
        // $references  = $this->references();
        // $childrens   = $this->childrens();
        // $train_dev   = $this->train_dev();
        // $voluntary   = $this->voluntary();
        // $work_exp    = $this->work_exp();
        // $other_info  = $this->other_info();


        /*$bground = $this->ebground(11);
        dd($bground);
        $emp   = array_merge($profile, $bground);
        $emp = implode("&", $profile[0]);
        //$hash = hash('sha256',implode("&", $emp));
        //$hash = '';
        $emp_arr['profile'] = $profile[0];
        dd($emp);
        //dd($users);
        for($i=0;$i<count($users);$i++) {
            foreach ($users[$i] as $key => $val) {
                //dd($key . ' ' . $val);
                if(!is_null($val) and !empty($val)) {
                    $emp .= $val . '&';
                }
            }
            $emp = rtrim($emp,"& ");
            //$hash = hash('sha256',$emp);
            dd($emp);
        }*/
        
        return view('user.create_esig', compact('users'));
    }

    function profile($id) {
    //    return DB::table('users')
    //             ->leftjoin('users_personal_informations', 'users_personal_informations.user_id', '=', 'users.id')
    //             ->select('first_name', 'last_name', 'middle_name', 'extname','contact_num','dob', 'pob', 'sex', 'c_status', 'height', 'weight', 'b_type', 
    //             'gsis', 'pagibig', 'phealth', 'sss', 'tin', 'emp_no', 'citizenship', 'citizenship_details', 'resident_house_block_lotno', 'resident_street', 
    //             'resident_subdivision_village', 'resident_barangay', 'resident_city_municipality', 'resident_province', 'resident_zipcode', 'permanent_house_block_lotno', 
    //             'permanent_street', 'permanent_subdivision_village', 'permanent_barangay', 'permanent_city_municipality', 'permanent_province', 'permanent_zipcode', 
    //             'tphone_no', 'mobile_no', 'email_add', 'spouse_sname', 'spouse_fname', 'spouse_mname', 'spouse_ext_name', 'spouse_occupation', 'business_name', 
    //             'business_address', 'business_tphone_no', 'father_sname', 'father_fname', 'father_mname', 'father_ext_name', 'mother_maiden_name', 'mother_sname', 
    //             'mother_fname', 'mother_mname', 'w_third_degree', 'w_fourth_degree', 'w_fourth_degree_details', 'administrative_offense', 'administrative_details', 
    //             'criminally_charged', 'date_filed', 'status_of_case', 'convicted_crime', 'convicted_details', 'separated_from_service', 'separated_from_service_details', 
    //             'candidate_national_local', 'candidate_national_local_details', 'resigned_gov_service', 'resigned_gov_service_details', 'acquired_status', 
    //             'acquired_status_details', 'indigenous_group', 'indigenous_group_details', 'person_disability', 'person_disability_details', 'solo_parent', 
    //             'solo_parent_details')
    //             ->where('view_account', 1)
    //             ->where('status','1')
    //             ->where('users.id', $id)
    //             ->get()
    //             ->toArray();

    $profiles = DB::table('users')
                    ->leftjoin('users_personal_informations', 'users_personal_informations.user_id', '=', 'users.id')
                    ->select(DB::raw("CONCAT_WS('&', first_name, last_name, middle_name, extname,contact_num,dob, pob, sex, c_status, height, weight, b_type, 
                    gsis, pagibig, phealth, sss, tin, emp_no, citizenship, citizenship_details, resident_house_block_lotno, resident_street, 
                    resident_subdivision_village, resident_barangay, resident_city_municipality, resident_province, resident_zipcode, permanent_house_block_lotno, 
                    permanent_street, permanent_subdivision_village, permanent_barangay, permanent_city_municipality, permanent_province, permanent_zipcode, 
                    tphone_no, mobile_no, email_add, spouse_sname, spouse_fname, spouse_mname, spouse_ext_name, spouse_occupation, business_name, 
                    business_address, business_tphone_no, father_sname, father_fname, father_mname, father_ext_name, mother_maiden_name, mother_sname, 
                    mother_fname, mother_mname, w_third_degree, w_fourth_degree, w_fourth_degree_details, administrative_offense, administrative_details, 
                    criminally_charged, date_filed, status_of_case, convicted_crime, convicted_details, separated_from_service, separated_from_service_details, 
                    candidate_national_local, candidate_national_local_details, resigned_gov_service, resigned_gov_service_details, acquired_status, 
                    acquired_status_details, indigenous_group, indigenous_group_details, person_disability, person_disability_details, solo_parent, 
                    solo_parent_details) profile"))
                    ->where('view_account', 1)
                    ->where('status','1')
                    ->where('users.id', $id)
                    ->get()
                    ->toArray();
    if(count($profiles) > 0) {
        return $profiles[0]->profile;
    }
    return null;
    }

    function ebground($id) {
        $ebs = DB::table("user_educational_bgrounds as eb")
                    ->join("educational_levels as el", "el.elid","=","eb.elid")
                    ->select(DB::raw("CONCAT_WS('&',school_name, education_level, education_from, education_to, education_earned, year_graduate, education_received) ebground"))
                    //->where("uid", access()->id())
                    ->where('uid', $id)
                    ->get()
                    ->toArray();
        $eb_concat = '';
        if(count($ebs) > 0) {
            foreach($ebs as $eb) {
                $eb_concat .= $eb->ebground;
            }
            return $eb_concat;
        }
        return null;
    }

    function eligilities($id) {
        $eligibs = DB::table('users_eligibilities')
                    ->select(DB::raw("CONCAT_WS('&', cs_eligibility, cs_rating, cs_date_taken, cs_conferment, license_no) eligibilities"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $eligib_concat = '';
        if(count($eligibs) > 0) {
            foreach($eligibs as $eligib) {
                $eligib_concat .= $eligib->eligibilities;
            }
            return $eligib_concat;
        }
        return null;
    }

    function references($id) {
        $refs = DB::table('users_references')
                    ->select(DB::raw("CONCAT_WS('&', name, address, tel_no) ref"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $ref_concat = '';
        if(count($refs) > 0) {
            foreach($refs as $ref) {
                $ref_concat .= $ref->ref;
            }
            return $ref_concat;
        }
        return null;
    }

    function childrens($id) {
        $childs = DB::table('users_spouse_childrens')
                    ->select(DB::raw("CONCAT_WS('&', name_children, dob) childrens"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $child_concat = '';
        if(count($childs) > 0) {
            foreach($childs as $child) {
                $child_concat .= $child->childrens;
            }
            return $child_concat;
        }
        return null;
    }

    function train_dev($id) {
        $trains = DB::table('users_trainings_developments')
                    ->select(DB::raw("CONCAT_WS('&', title_of_learning_development, inc_date_from, inc_date_to, num_hours, type_of_id, sponsored) trainings"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $train_concat = '';
        if(count($trains) > 0) {
            foreach($trains as $train) {
                $train_concat .= $train->trainings;
            }
            return $train_concat;
        }
        return null;
    }

    function voluntary($id) {
        $vws = DB::table('users_voluntary_works')
                    ->select(DB::raw("CONCAT_WS('&', vwork_name_address_org, vwork_name_from, vwork_name_to, vwork_name_num_hours, vwork_name_position) voluntary"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $vw_concat = '';
        if(count($vws) > 0) {
            foreach($vws as $vw) {
                $vw_concat .= $vw->voluntary;
            }
            return $vw_concat;
        }
        return null;
    }

    function work_exp($id) {
        $wes = DB::table('users_work_experiences')
                    ->select(DB::raw("CONCAT_WS('&', wexp_from, wexp_to, wexp_pos_title, wexp_company, wexp_salary, wexp_pay_grade, wexp_status_of_appointment, wexp_govt_service) work_exp"))
                    ->where('user_id', $id)
                    ->get()
                    ->toArray();
        $we_concat = '';
        if(count($wes) > 0) {
            foreach($wes as $we) {
                $we_concat .= $we->work_exp;
            }
            return $we_concat;
        }
        return null;
    }

    function other_info($id) {
        $ois = DB::table('user_other_informations')
                        ->select(DB::raw("CONCAT_WS('&', hobby, non_academic, organization) other_info"))
                        ->where('user_id', $id)
                        ->get()
                        ->toArray();
        $other_info_concat = '';
        if(count($ois) > 0) {
            foreach($ois as $oi) {
                $other_info_concat .= $oi->other_info;
            }
            return $other_info_concat;
        }
        return null;
    }


    public function store_esig() {
        //dd(request()->all());
        $alert = ""; 
        $msg = "";
        if(request()->esig != NULL) {
            if(request()->esig->getError() == 0) {
                //if (file_exists('/var/www/html/portal/public' . '/upload/employee/' . request()->emp_user . '-dtr.png')) {
				/*if (file_exists('/var/www/html/portal/public' . '/upload/e-signature/' . request()->emp_user . 'e-sig.png')) {
                    $alert = "err_msg";
                    $msg = "User e-sig already exist!";
                    //dd($msg);
                } else {*/
                    //dd('save');
                    $user = User::find(request()->emp_user);
					$img_path = '/var/www/html/portal/public/upload/e-signature';
                    //request()->emp_user
                    $filename = request()->emp_user . 'e-sig.png'; //request()->file('document')->getClientOriginalName();
                    //$newfilename = access()->id() . str_random(10) . '.' . $dt->timestamp . '.' . request()->file('document')->getClientOriginalExtension();               
                    request()->esig->move($img_path, $filename);

                    $user->e_signature = 'upload/e-signature/'.$filename;
					//$user->dtr_img = "upload/e-signature/".$filename;
					//dd($user);
                    $user->save();

                    $alert = "success";
                    $msg = "Successfully save!";
                    //$document_path = $document_path . $newfilename;
                    //dd($esig_path);
                    //$documents->to_path = $document_path;
                    //$documents->filename = $filename;
                /*}*/
            }else {
                throw new GeneralException(request()->file('esig')->getErrorMessage());
            }
            //$to->travel_documents()->save($documents);
        }
        //dd($alert);
        return redirect()->route('create_esig')->with($alert, $msg);
    }
}
