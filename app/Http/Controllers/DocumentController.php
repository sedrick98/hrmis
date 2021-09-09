<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
*/
use Yajra\DataTables\Facades\DataTables;
use App\dt_documents;
use App\dt_document_routes;
use App\Notifications\DocumentTracking;
use App\Notifications\DocumentClose;
use App\dt_document_control;
use App\dt_document_form;
use App\dt_document_comment;
use App\User;
use DB;
use Carbon\Carbon;
use Auth;
use Hashids\Hashids;
use App\Traits\Module;
use PDF;
use QrCode;
use Crypt;


class DocumentController extends Controller
{
    use Module;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function __construct() {
	// 	$data = [ 'title_page' => 'Action Done' ];
	// 	View::share('data', $data);
    // }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Auth::user()->id);
        //$users = User::select('last_name','id')->where('id','!=',auth()->user()->id)->orderBy('last_name')->get();
        //$users = User::select('last_name','id')->orderBy('last_name')->get();
        $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
                ->where('id', '!=', auth()->user()->id)
                ->where('view_account', 1)
                ->where('status','1')->orderBy('last_name')
                ->get();
        // $users = DB::table('users')
        //             ->select(DB::raw("CONCAT(first_name,' ', middle_name,' ', last_name) as name"), 'id')
        //             ->orderBy('last_name')->get();
        $forms = dt_document_form::select('name','df_id')->where('active', 1)->orderBy('name')->get();
        //$users = User::all()->toArray();
        //dd($users);
        //$forms = array();
        //$users = array();
        
        return view('d_tracking.document_form', compact('users','forms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // return response()->json(["msg"=>"asd"]);
        DB::beginTransaction();
        try {
            
            //dd(auth()->user()->first_name);
            //dd(Auth::user()->division->abbr);
            $dt = Carbon::parse(Carbon::now());
            //dd(111);
            $user_division = Auth::user()->division->abbr;

            //dd($dt->year);
            //dd($this->assignControlNum(1));
            //dd(auth()->user()->division->abbr);
            $actions = "";
            foreach (request()->chk_actions as $a) {
                // if($s=="Other") $actions .= request()->txt_other_setup.', ';
                $actions .= $a.', ';
            }


            $documents                = New dt_documents;
            $documents->d_type        = request()->d_type;
            $documents->d_description = request()->d_description;
            $documents->d_action      = $actions;
            $documents->uid           = Auth::user()->id;
            $documents->save();

            // DB::table("dt_document_control")
            // ->insert(
            //     [
            //         "d_id" => $documents->d_id, 
            //         "d_control_num" => '0000',
            //         "division" => $user_division,
            //         "d_year" => $dt->year
            //     ]
            // );
            // $control_num = $user_division
            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),

            DB::insert('INSERT INTO dt_document_control SET 
                        d_control_num=?, 
                        d_id=?, 
                        division=?, 
                        control_num=CONCAT(division,"-",DATE_FORMAT(NOW(), "%y-%m"),"-",d_control_num),
                        d_year=(DATE_FORMAT(NOW(), "%Y"))
                    ', [
                        dt_document_control::whereRaw('d_year=DATE_FORMAT(NOW(), "%Y")')
                        ->select(DB::raw('COALESCE(MAX(d_control_num)+1, 1) as ctrl'))->value('ctrl'), 
                        $documents->d_id, 
                        $user_division,

                    ]);

            $d_route = New dt_document_routes;
            $d_route->d_id = $documents->d_id;
            $d_route->user_id = Auth::user()->id;
            $d_route->route_user = request()->route_user;
            $d_route->d_created = 1;
            $d_route->d_is_received = 0;
            $d_route->d_is_forwarded = 0;
            $d_route->d_action = $actions;
            $d_route->d_remarks = request()->d_remarks;
            $d_route->save();
            $d_route->dr_id = $d_route->dr_id;
            
            //dd($d_route);
            $d_route->message = "<strong>" . auth()->user()->first_name . ' '. auth()->user()->last_name . "</strong> routed a Document";
            
            $notify_user = User::find(request()->route_user);
            $notify_user->notify(new DocumentTracking($d_route));
            //dd($d_route);
            //$notify_user->notify(new DocumentTracking(request()->all()));
            // return redirect()->route('document.create')->with("success", "Document Added!");\
            DB::commit();
            $did = \Crypt::encrypt($documents->d_id);
            return response()->json(["msg"=>$did]);
        } catch (\Exceptions $exception) {
            DB::rollBack();
            parent::report($exception);
        }
        return response()->json(["msg"=>'e']);
    }

    public function check_route($did=0,$uid=0,$route_id=0,$check_route='') {
        // created, receive, forwarded
        // $check_val=0;
        // if($check_route=='d_created') $check_val=1;
        if($check_route=="is_received") $$check_route='d_is_received';
        elseif($check_route=='is_forwarded') $check_route='d_is_forwarded';

        return dt_document_routes::where('d_id', $did)->where('user_id',$uid)->where('route_user',$route_id)->where($check_route, 0)->count();
    }

    // public function search() {
        
    //     $docs = DB::table('dt_document_routes as dr')
    //                 ->join('dt_documents as d', 'd.d_id', '=', 'dr.d_id')
    //                 ->select('d.d_id','d_description','d_type','status','d.created_at',
    //                           DB::raw('(SELECT CONCAT(division,"-",d_control_num,"-",d_year) 
    //                                   FROM dt_document_control dc WHERE dc.d_id=d.d_id) as control')
    //                 )
    //                 ->where('user_id', auth()->user()->id)
    //                 ->where('d_created', 1)
    //                 ->orWhere('','like','%'.request()->search_docs.'%')
    //                 ->get(); 
    //     return view('backend.d_tracking.user_documents', compact('docs'));                 
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $did = \Crypt::decrypt($id);
        $document = dt_documents::findOrFail($did);
        // $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
        //         ->where('id', '!=', auth()->user()->id)
        //         ->where('view_account', 1)
        //         ->where('status','1')->orderBy('last_name')
        //         ->get();
        // $forms = dt_document_form::select('name','df_id')->orderBy('name')->get();
        return view('d_tracking.document_edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $did = \Crypt::decrypt($id);
        $document = dt_documents::findOrFail($did);
        $document->d_description = request()->d_description;
        $document->save();

        return redirect('document/edit/'.$id)->with('msg','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($did)
    {
        $did = \Crypt::decrypt($did);
        $d = dt_documents::findOrFail($did);
       
        if($d->uid==Auth::user()->id) {
            $d->delete();
            if($d->trashed()) {
                return response()->json(['msg', 'Successfully deleted!']);
            }
        }else {
            abort(404);
        }
    }
    
    function assignControlNum($user_division) {
        $ctrl = DB::table("dt_document_control")
        ->select(DB::raw('count(*) as control'))
        ->where("division", "=", $user_division)
        ->get()
        ->toArray();

        if($ctrl[0]->control===0)
            return 1;
        else
            return $ctrl[0]->control++;
    }

    public function routed_docs() {
        $documents = DB::table('dt_document_routes as dr')
                    ->join('dt_documents as d', 'dr.d_id', '=', 'd.d_id')
                    ->select('d.d_id','d.closed_by_user','dr.dr_id','d.d_description', 'd.d_type', 'dr.d_remarks','d.created_at as created','dr.created_at as routed',
                            // DB::raw('(SELECT CONCAT(division,"-",id,"-",d_year) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT control_num FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    ->where('route_user', auth()->user()->id)
                    ->where('d_is_forwarded','!=', 0)
                    ->orderBy('dr.dr_id', 'DESC')
                    ->get();
        $forms = array();
        $users = array();
        // $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
        //                 ->where('id', '!=', auth()->user()->id)
        //                 ->where('view_account', 1)
        //                 ->where('status','1')->orderBy('last_name')
        //                 ->get();
        // // $users = DB::table('users')
        // //             ->select(DB::raw("CONCAT(first_name,' ', middle_name,' ', last_name) as name"), 'id')
        // //             ->orderBy('last_name')->get();
        // $forms = dt_document_form::select('name','df_id')->orderBy('name')->get();
        return view('d_tracking.document_routed', compact('documents', 'forms', 'users'));
    }

    public function search_document() {
        return view('document.qrsearch');
    }

    public function d_route() {
        //$d_route = dt_document_routes::where('route_user','=', auth()->user()->id)->get();
        //$users = User::select('last_name','id')->where('id','!=', auth()->user()->id)->orderBy('last_name')->get();
        $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
                ->where('id', '!=', auth()->user()->id)
                ->where('view_account', 1)
                ->orderBy('last_name')
                ->get();
        $d_routes = DB::table('dt_document_routes as dr')
                    ->join('dt_documents as d', 'dr.d_id', '=', 'd.d_id')
                    ->select('d.d_id','d.closed_by_user','dr.dr_id','d.d_description', 'd.d_type', 'dr.d_remarks','d.created_at as created','dr.created_at as routed', 'dr.d_action',
                            // DB::raw('(SELECT CONCAT(division,"-",id,"-",d_year) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT control_num FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    ->where('route_user', auth()->user()->id)
                    ->where('d_is_received', 0)
                    ->where('d_is_forwarded', 0)
                    ->whereNull('deleted_at')
                    ->whereNull('closed_by_user')
                    ->orderBy('dr.created_at','DESC')
                    ->get();
                    //->toSql();
                    //dd($d_routes);
        //$d_route = dt_document_routes::find(2);
        //dd($d_routes);
        return view('d_tracking.document_pending', compact('d_routes','users'));
    }

    public function document_view($id) {
        $did = \Crypt::decrypt($id);

        $dr = dt_document_routes::where('d_id', $did)->where(function($q) {
            $q->where('user_id', auth()->user()->id)->orWhere('route_user', auth()->user()->id);
        })->count();

        if($dr<=0) abort(404); 

        $comment = new dt_document_comment;
        $comment->id = auth()->user()->id;
        $notif_comment = $comment->unreadNotifications;
        foreach ($notif_comment as $notif) {
            if((int)$notif->data["Comment"]["d_id"]===(int)$did) {
                $notif->markAsRead();
            }
        }


        $document = dt_documents::findOrFail($did);
// dd($document);
        $dc = dt_document_comment::where('d_id', $did)->orderBy('created_at', 'ASC')->get();

        // dd($dr);
        return view("d_tracking.document_view", compact('document', 'dc'));
    }

    // public function ucomment($id) {
    //     $did = \Crypt::decrypt($id);
        
    //     $c              = New dt_document_comment;
    //     $c->d_id        = $did;
    //     $c->uid_comment = Auth::user()->id;
    //     $c->comment     = request()->dcomment;
    //     $c->save();

    //     return redirect('document/view/'.$id)->with('msg', 'Comment Added!');
    // }

    public function receivelist() {
        $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
                ->where('id', '!=', auth()->user()->id)
                ->where('view_account', 1)
                ->orderBy('last_name')
                ->get();
        $d_routes = DB::table('dt_document_routes as dr')
                    ->join('dt_documents as d', 'dr.d_id', '=', 'd.d_id')
                    ->select('d.d_id','d.closed_by_user','dr.dr_id','d.d_description', 'd.d_type', 'dr.d_remarks','d.created_at as created','dr.created_at as routed', 'dr.d_action',
                            // DB::raw('(SELECT CONCAT(division,"-",id,"-",d_year) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT control_num FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    ->where('route_user', auth()->user()->id)
                    ->where('d_is_received', 1)
                    ->where('d_is_forwarded', 0)
                    ->whereNull('deleted_at')
                    ->whereNull('closed_by_user')
                    ->orderBy('dr.created_at','DESC')
                    ->get();
                    //->toSql();
                    //dd($d_routes);
        //$d_route = dt_document_routes::find(2);
        //dd($d_routes);
        return view('d_tracking.document_received', compact('d_routes','users'));
    }

    public function documentShow($id=0) {
        //$d_route = dt_document_routes::where('route_user','=', auth()->user()->id)->get();
        //dd($id);
        $users = User::select('last_name','id')->where('id','!=',auth()->user()->id)->orderBy('last_name')->get();
        $d_routes = DB::table('dt_document_routes as dr')
                    ->join('dt_documents as d', 'dr.d_id', '=', 'd.d_id')
                    ->select('d.d_id','d.closed_by_user','dr.dr_id','d.d_description', 'd.d_type', 'dr.d_remarks','d.created_at as created','dr.created_at as routed',
                            // DB::raw('(SELECT CONCAT(division,"-",id,"-",d_year) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT control_num FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    ->where('route_user', auth()->user()->id)
                    ->where('d_is_received', 0)
                    ->where('dr_id', $id)
                    ->whereNull('d.deleted_at')
                    ->whereNull('closed_by_user')
                    ->orderBy('dr.created_at', 'DESC')
                    ->get();
                    //->toSql();
                    //dd($d_routes);
        //$d_route = dt_document_routes::find(2);
        
        return view('d_tracking.document_pending', compact('d_routes','users'));
    }

    public function receive_document() {
        DB::beginTransaction();
        try {
            // d_id dr_id
            $route_id = explode('-', request()->id);
            $did      = $this->reHash($route_id[0])>0 ? $this->reHash($route_id[0]):0;
            $drid     = $this->reHash($route_id[1])>0 ? $this->reHash($route_id[1]):0;
            $update_route = dt_document_routes::find($drid);

            // dt_document_routes::where('d_id', $did)->where('user_id',$uid)->where('route_user',$route_id)->where($check_route, 0)->count();
            // $num_route = $this->check_route($did,auth()->user()->id,request()->route_user,'is_received'); //$did=0,$uid=0,$route_id=0,$check_route='d_created'

            if(!is_null($update_route) && is_null($update_route->d_date_received)) {
                $update_route->d_is_received = 1;
                $update_route->d_date_received = Carbon::now();
                $update_route->save();
                
                // $doc_route = New dt_document_routes;
                // $doc_route->d_id            = $did;
                // $doc_route->user_id         = auth()->user()->id;
                // $doc_route->route_user      = request()->route_user;
                // $doc_route->d_remarks       = request()->remarks;
                // $doc_route->d_is_received   = 0;
                // $doc_route->save();
                // $docs->dr_id = $doc_route->dr_id;

                // $this->markread_notif($rone);

                // $docs->d_id = $did;
                // $docs->message = "<strong>" . auth()->user()->first_name . ' '. auth()->user()->last_name . "</strong> routed a Document";
                // $notify_user = User::find(request()->route_user);
                // $notify_user->notify(new DocumentTracking($docs));
                
                DB::commit();
                $num_pending = dt_document_routes::num_pending();
                return response()->json(["msg" => "Success", "num_pending" => $num_pending]);
            }
            return response()->json(["msg" => "Cant Save"]);

            // $dc_route = dt_document_routes::find($drid);
            // $dc_route->d_is_received = 1;
            // $dc_route->save();

            // if($dc_route) {
                // DB::commit();
                // return response()->json(["msg" => "Success"]);
            // }
            DB::rollBack();
        } catch (\Exceptions $exception) {
            DB::rollBack();
            parent::report($exception);
        }
    }

    public function d_reply() {
        // dr_id = $route_id[1];
        // d_id = $route_id[0];
        DB::beginTransaction();
        try {
            $docs         = (object) [];
            $route_id     = explode('-', request()->id);
            $did        = $this->reHash($route_id[0]);
            $drid         = $this->reHash($route_id[1]);
            $update_route = dt_document_routes::find($drid);
            $num_route = $this->check_route($did,auth()->user()->id,request()->route_user,'is_forwarded'); //$did=0,$uid=0,$route_id=0,$check_route='d_created'

            if(!is_null($update_route) && $num_route==0) {
                $actions = "";
                foreach (request()->chk_actions as $a) {
                    // if($s=="Other") $actions .= request()->txt_other_setup.', ';
                    $actions .= $a.', ';
                }

                $update_route->d_is_forwarded = 1;
                $update_route->d_date_forwarded = Carbon::now();
                $update_route->save();
                
                $doc_route = New dt_document_routes;
                $doc_route->d_id            = $did;
                $doc_route->user_id         = auth()->user()->id;
                $doc_route->route_user      = request()->route_user;
                $doc_route->d_action        = $actions;
                $doc_route->d_remarks       = request()->remarks;
                $doc_route->d_is_received   = 0;
                $doc_route->save();
                $docs->dr_id = $doc_route->dr_id;

                $this->markread_notif($drid);

                $docs->d_id = $did;
                $docs->message = "<strong>" . auth()->user()->first_name . ' '. auth()->user()->last_name . "</strong> routed a Document";
                $notify_user = User::find(request()->route_user);
                $notify_user->notify(new DocumentTracking($docs));
                
                DB::commit();
                return response()->json(["msg" => "Success"]);
            }            
            return response()->json(["msg" => "Cant Save"]);
        } catch (\Exceptions $exception) {
            DB::rollBack();
            parent::report($exception);
        }
        DB::rollBack();
        return response()->json(["msg" => "Cant Save"]);
        //return response()->json(auth()->user()->id);
    }

    public function d_reroute() {
        // dr_id = $route_id[1];
        // d_id = $route_id[0];
        // $update_route = dt_document_routes::where('d_id', 1)->orderBy('created_at', 'desc')->get()->first();
        DB::beginTransaction();
        try {
            $docs         = (object) [];
            $route_id     = explode('-', request()->id);
            $did        = $this->reHash($route_id[0]);
            $drid         = $this->reHash($route_id[1]);
            $update_route = dt_document_routes::find($drid);
            $last_route = dt_document_routes::where('d_id', $did)->orderBy('created_at', 'desc')->get()->first();
            $num_route = $this->check_route($did,auth()->user()->id,request()->route_user, 'is_forwarded'); //$did=0,$uid=0,$route_id=0,$check_route='d_created'

            if(!is_null($update_route) && $num_route==0) {
                $actions = "";
                foreach (request()->chk_actions as $a) {

                    // if($s=="Other") $actions .= request()->txt_other_setup.', ';
                    $actions .= $a.', ';
                }

                $update_route->d_is_forwarded = 1;
                $update_route->d_date_forwarded = Carbon::now();
                $update_route->save();
                
                $doc_route = New dt_document_routes;
                $doc_route->d_id            = $did;
                $doc_route->user_id         = $last_route->route_user;
                $doc_route->route_user      = $last_route->user_id;
                $doc_route->d_action        = "RTS";
                $doc_route->d_remarks       = $actions;
                // $doc_route->d_is_received   = 0;
                $doc_route->save();
                $docs->dr_id = $doc_route->dr_id;

                // $this->markread_notif($drid);

                // $docs->d_id = $did;
                // $docs->message = "<strong>" . auth()->user()->first_name . ' '. auth()->user()->last_name . "</strong> routed a Document";
                // $notify_user = User::find(request()->route_user);
                // $notify_user->notify(new DocumentTracking($docs));
                
                DB::commit();
                $num_pending = dt_document_routes::num_pending();
                return response()->json(["msg" => "Success", "num_pending" => $num_pending]);
            }        
            DB::rollBack();    
            return response()->json(["msg" => "Cant Save"]);
        } catch (\Exceptions $exception) {
            DB::rollBack();
            parent::report($exception);
        }
        DB::rollBack();
        return response()->json(["msg" => "Cant Save"]);
        //return response()->json(auth()->user()->id);
    }

    public function markread_notif($dr_id) {
        //Mark as Read Notification (DocumentTracking)
        $notif_docs = auth()->user()->unreadNotifications()->where('type','App\Notifications\DocumentTracking')->get();
        foreach ($notif_docs as $notif) {
            if((int)$notif->data['document']['dr_id']===(int)$dr_id) {
                auth()->user()->unreadNotifications->where('id',$notif->id)->markAsRead();
                break;
            }
        }
    }

    public function remarks($id) {
        $id = $this->reHash($id);
        $routes = DB::table("dt_document_routes as dr")
                        ->select('d_remarks',
                                 DB::raw('(SELECT last_name FROM dost_hrmis.users u WHERE dr.user_id=u.id) as u1'),
                                 DB::raw('(SELECT last_name FROM dost_hrmis.users u WHERE dr.route_user=u.id) as u2')
                                )
                        ->where('d_id', $id)
                        ->get();
        $res = "";
        // $routes = dt_document_routes::where('d_id', $id)->get();
        $a = array();
        // foreach($routes as $route)
        //     $a[] = $route->users;
        // dd($a);
        //dd($routes->dt_documents);
        $res = "<ul>";
        foreach($routes as $route) {
             $res .= "<li>". $route->u1 .' <i class="fa fa-arrow-right"></i> '. $route->u2."</li>";
             $res .= "<ul><li>".$route->d_remarks."</li></ul>";
        }
        $res .= "</ul>";
        //print_r($res);
        //dd($routes);
        return response()->json(["remarks" => $res]);
    }

    public function d_close() {
        //dd(111);
        $docs     = (object) [];
        $route_id = explode('-', request()->id);
        $did      = $this->reHash($route_id[0]);
        $drid     = $this->reHash($route_id[1]);
        $date_now = Carbon::now();

        $document = dt_documents::findOrFail($did);
        $document->closed_by_user = auth()->user()->id;
        $document->close_remark = request()->remark;
        $document->status = "closed";
        $document->save();
        
        $update_route                   = dt_document_routes::findOrFail($drid);
        $update_route->d_is_received    = 1;
        $update_route->d_date_received  = $date_now;
        $update_route->d_date_forwarded = $date_now;

        $update_route->save();

        $droute                        = new dt_document_routes;
        $droute->d_id                  = $document->d_id;
        $droute->user_id               = auth()->user()->id;
        $droute->d_action              = "CLOSED";
        $droute->d_remarks             = request()->remark;
        $droute->d_is_closed           = 1;
        // $droute->d_date_received       = $date_now;
        $droute->d_date_closed         = $date_now;
        $droute->save();

        $this->markread_notif($route_id[1]);
        //$routes = dt_document_routes::where('d_id',$route_id[0])
        //         ->where('d_created',1)->get();
        
        
        //$notify_user = User::find($routes[0]->user_id);

        // $docs->d_id = $route_id[0];
        // $docs->dr_id = $route_id[1];
        // $docs->message = "Document ".request()->ctrlnum." closed by <strong>" . auth()->user()->first_name . ' '. auth()->user()->last_name . "</strong>";
        // $docs->status = 'closed';
        // $notify_user->notify(new DocumentClose($docs));


        return response()->json(["message"=>"Closed"]);
        
        //return response()->json(["message"=>$document]);
    }

    public function user_documents() {
        // $docs = dt_document_routes::where('user_id', auth()->user()->id)
        //                           ->where('d_created', 1)->get();
        //dd(auth()->user());+
        // $docs = DB::table('dt_document_routes as dr')
        //             ->join('dt_documents as d', 'd.d_id', '=', 'dr.d_id')
        //             ->select('d.d_id','d_description','d_type','status','d.created_at',
        //                       DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.d_control_num) 
        //                               FROM dt_document_control dc WHERE dc.d_id=d.d_id) as control'),
        //                       DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
        //             )
        //             ->where('d.uid', auth()->user()->id)
        //             ->where('d_created', 1)
        //             // ->orderBy('d.created_at','DESC')
        //             ->get();
                    // dd();

        $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
        ->where('id', '!=', auth()->user()->id)
        ->where('view_account', 1)
        ->where('status','1')->orderBy('last_name')
        ->get();
        // $users = DB::table('users')
        //             ->select(DB::raw("CONCAT(first_name,' ', middle_name,' ', last_name) as name"), 'id')
        //             ->orderBy('last_name')->get();
        $forms = dt_document_form::select('name','df_id')->where('active', 1)->orderBy('name')->get();
        return view('d_tracking.user_documents', compact('users', 'forms'));
    }

    public function get_my_document() {
        $q = DB::table('dt_documents as d')
                    ->join('dt_document_routes as dr', 'dr.d_id', '=', 'd.d_id')
                    ->join('dt_document_control as dc', 'dc.d_id', '=', 'd.d_id')
                    ->select('d.d_id','d.d_description','d.d_type','d.status','d.created_at', 'dc.control_num',
                            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.d_control_num) 
                            //         FROM dt_document_control dc WHERE dc.d_id=d.d_id) as control'),
                            // DB::raw('CONCAT(dc.division,"-",DATE_FORMAT(dc.created_at, "%y-%m"),"-",dc.d_control_num) as control'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    ->where('d.uid', auth()->user()->id)
                    ->where('dr.d_created', 1)
                    ->whereNull('d.deleted_at')
                    ->orderBy('d.status', 'DESC')
                    ->orderBy('d.created_at','DESC');
                    

        // $q = DB::table('dt_documents as d')
        //             ->join('dt_document_routes as dr', 'dr.d_id', '=', 'd.d_id')
        //             ->join('dt_document_control as dc', 'dc.d_id', '=', 'd.d_id')
        //             ->select('d.d_id','d_description','d_type','status','d.created_at', 'dc.control_num as control',
        //                     // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) 
        //                     //         FROM dt_document_control dc WHERE dc.d_id=d.d_id) as control'),
        //                     DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
        //             )
        //             ->where('user_id', auth()->user()->id)
        //             ->where('d_created', 1)
        //             ->orderBy('created_at','DESC');
        $dtable = Datatables::of($q);

        $dtable->addIndexColumn();


        $dtable->addColumn('form_type', function($dc) {
            return $dc->form_type;
        });

        // $dtable->addColumn('d_action', function($dc) {
        //     return $dc->d_action;
        // });
        
        $dtable->addColumn('actions', function($dc) {
            // return '<button type="button" class="btn btn-info btn-xs route_details" data-toggle="modal" data-target="#RouteDetails" title="Route History">
            //                 <span style="display:none;" id="did">{{ hashId($doc->d_id)}}</span>
            //                 <i class="fa fa-info-circle fa-xs"></i>
            //             </button> | 
            //             <button type="button" class="btn btn-success btn-xs print_dslip" title="Print">
            //             <i class="fa fa-print fa-xs"></i>
            //         </button>';

            $buttons = '<a href=""class="btn btn-primary btn-xs route_details" data-toggle="modal" data-target="#RouteDetails" title="ROUTE HISTORY">
                                <span style="display:none;" id="did">'.hashId($dc->d_id).'</span>
                                <i class="fa fa-info-circle fa-xs"></i>
                            </a> 
                        | 
                        <a class="btn btn-success btn-xs print_dslip" target="_blank" title="PRINT">
                            <span style="display:none;" id="printdid">'.\Crypt::encrypt($dc->d_id).'</span>
                            <i class="fa fa-print fa-xs"></i>
                        </a>
                        | 
                        <a href="'.URL('document/view/'.\Crypt::encrypt($dc->d_id)).'"class="btn btn-info btn-xs document_edit" title="VIEW">
                            <i class="fa fa-eye fa-xs"></i>
                        </a>';
            
            if($dc->status!='closed') {
                $buttons .= '| 
                            <a href="'.URL('document/edit/'.\Crypt::encrypt($dc->d_id)).'"class="btn btn-warning btn-xs document_edit" title="EDIT">
                                <i class="fa fa-edit fa-xs"></i>
                            </a>';
                $buttons .= '| 
                            <a class="btn btn-danger btn-xs document_delete" title="DELETE">
                                <i class="fa fa-trash fa-xs"></i>
                            </a>';
            }         
            return $buttons;
        });
        $dtable->rawColumns(['actions']);

        // <!-- Route Details  -->
        //             <button type="button" class="btn btn-info btn-xs route_details" data-toggle="modal" data-target="#RouteDetails" title="Route History">
        //                 <span style="display:none;" id="did">{{ hashId($doc->d_id)}}</span>
        //                 <i class="fa fa-info-circle fa-xs"></i>
        //             </button>
        //             |
        //             {{-- <button onclick="window.open('https://www.google.com', '_blank');">BUTTON TEST</button> --}}
        //             <button type="button" class="btn btn-success btn-xs" onclick="window.open(document.location.href+'/print/{{encrypt($doc->d_id)}}', '_blank');" title="Print">
        //                 <i class="fa fa-print fa-xs"></i>
        //             </button>
        //             {{-- <button type="button" class="btn btn-info" formtarget="_blank">asdasdsa --}}
        //                 {{-- <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Route History"></i> --}}
        //             {{-- </button> --}}
        //             <!-- Remarks  -->
        //             <!-- <button type="button" class="btn btn-info close_document" data-toggle="modal" data-target="#AssignedModal">
        //                 <i class="fas fa-comment-dots"></i>
        //             </button>  -->



        // $dtable->addColumn('emp_name', function($e) {
        //     return $e->last_name . ', ' . $e->first_name;
        // });
        // CONCAT(dc.division,"-",DATE_FORMAT(dc.created_at, "%y-%m"),"-",dc.d_control_num)
        // $dtable->filterColumn('control', function($query, $keyword) {
        //     // $sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
        //     $sql = 'CONCAT(dc.division,"-",DATE_FORMAT(dc.created_at, "%y-%m"),"-",dc.d_control_num) like ?';
        //     $query->whereRaw($sql, ["%{$keyword}%"]);
        // });

         return $dtable->make(true); 
    }

    public function route_details($id) {
        //dd($id);
        $id = $this->reHash($id);
        $as = dt_document_routes::where('d_id', $id)
                                  ->orderBy("dr_id", "DESC")
                                  ->get();
        $d = "";
        $date_rec = "";
        $duration_received = "";
        $duration_forwarded = "";
        //dd($a[0]->created_at . $a[0]->d_date_received);

        // $datetime1 = date_create('2009-10-11 06:00:00');
        // $datetime2 = date_create('2009-10-13 21:00:00');
        //dd($a[0]->user->last_name);
        
        foreach($as as $a) {
            // $datetime1 = date_create($a->created_at);
            // //$datetime2 = ($a->d_date_received!="") ? date_create($a->d_date_received):"";
            // $datetime2 = ($a->d_date_received!="") ? date_create($a->d_date_received):Carbon::now();
            // $date_rec = ($a->d_date_received!="") ? Carbon::parse($a->d_date_received)->format('M d, Y h:i:s'):"";
            
            $created_at     = date_create($a->created_at);
            $date_received  = ($a->d_date_received!="") ? date_create($a->d_date_received):Carbon::now();
            $date_forwarded = ($a->d_date_forwarded!="") ? date_create($a->d_date_forwarded):Carbon::now();

            $received  = ($a->d_date_received!="") ? Carbon::parse($a->d_date_received)->format('M d, Y h:i:s'):"";
            $forwarded = ($a->d_date_forwarded!="") ? Carbon::parse($a->d_date_forwarded)->format('M d, Y h:i:s'):"";
// Received = received-created_at; Forwarded = received-forwarded;

            if($a->d_date_received=="" && $a->d_is_received==0) {
                $interval_forwarded = date_diff($created_at, $date_forwarded);

                $duration_received  = "";
                $duration_forwarded = $interval_forwarded->format('%d day/s %H:%I:%S');
            }elseif($a->d_date_received!="" && $a->d_is_received==1) {
                $interval_received  = date_diff($created_at, $date_received);
                $interval_forwarded = date_diff($date_received, $date_forwarded);

                $duration_received  = $interval_received->format('%d day/s %H:%I:%S');
                $duration_forwarded = $interval_forwarded->format('%d day/s %H:%I:%S');
            }
            
            if($a->d_is_closed==1) {
                // $closed  = ($a->d_date_closed!="") ? Carbon::parse($a->d_date_closed)->format('M d, Y h:i:s'):"";
                // $interval_received  = date_diff($created_at, $date_received);
                // $interval_forwarded = date_diff($date_received, $date_forwarded);

                // $duration_received  = $interval_received->format('%d day/s %H:%I:%S');
                // $duration_forwarded = $interval_forwarded->format('%d day/s %H:%I:%S');
                // $received = $closed;
                $duration_received = $duration_forwarded = $received = $forwarded = "-";
                
                
            }
            // $interval_received  = date_diff($created_at, $date_received);
            // $interval_forwarded = date_diff($date_received, $date_forwarded);
            // background-color: #d9edf7; COLOR ng FROM, background-color: #dff0d8; COLOR ng FORWARDED
            if($a->user->id==auth()->user()->id) $d .= "<tr class='row_from_user'>";
            else if($a->route_to_user->id==auth()->user()->id) $d .= "<tr class='row_routed_user'>";
            else $d .= "<tr>";

            // $d .= "<tr>";
            // if($a->user->id==auth()->user()->id) $d .= "<td class='info'>".$a->user->last_name.", ".$a->user->first_name."</td>";
            // else 
            // if($a->route_to_user->id==auth()->user()->id) $d .= "<td class='info'>".$a->route_to_user->last_name.", ".$a->route_to_user->first_name."</td>";
            // else 
            $d .= "<td>".$a->user->last_name.", ".$a->user->first_name."</td>";
            $d .= "<td>".$a->route_to_user->last_name.", ".$a->route_to_user->first_name."</td>";
            $d .= "<td>".$a->d_action."</td>";
            $d .= "<td>".$a->d_remarks."</td>";
            $d .= "<td>".$received."</td>";
            $d .= "<td>".$forwarded."</td>";
            $d .= "<td>".$duration_received."</td>";
            $d .= "<td>".$duration_forwarded."</td>";
            // $d .= "<td>".$interval_received->format('%d day/s %H:%I:%S')."</td>";
            // $d .= "<td>".$interval_forwarded->format('%d day/s %H:%I:%S')."</td>";
            //$d .= "<td>".$interval->format('%d day/s')."</td>";
            $d .= "</tr>";
        }
        return response()->json(["res"=>$d]);
    }

    public function search_all() {        
        $documents = DB::table('dt_documents as d')
                    ->select('d.d_id','d.closed_by_user','d.d_description', 'd.d_type', 'd.created_at as created','d.status',
                            // DB::raw('(SELECT CONCAT(division,"-",id,"-",d_year) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            // DB::raw('(SELECT CONCAT(division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id) FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT control_num FROM dt_document_control dc WHERE dc.d_id=d.d_id) as ctrlnum'),
                            DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=d.d_type) as form_type')
                    )
                    //->where('d_is_received', 0)
                    //->whereNull('closed_by_user')
                    ->get();
        $forms = array();
        $users = array();
                    // $users = User::select(DB::raw("CONCAT(last_name,', ',first_name) as name"),'id')
        //         ->where('id', '!=', auth()->user()->id)
        //         ->where('view_account', 1)
        //         ->where('status','1')->orderBy('last_name')
        //         ->get();
        // // $users = DB::table('users')
        // //             ->select(DB::raw("CONCAT(first_name,' ', middle_name,' ', last_name) as name"), 'id')
        // //             ->orderBy('last_name')->get();
        // $forms = dt_document_form::select('name','df_id')->orderBy('name')->get();           
        return view('d_tracking.documents_list', compact('documents', 'forms', 'users'));
    }

    public function print_created_doc($dc) {
        $dc_id = Crypt::decrypt($dc);
        $dc = dt_documents::findOrFail($dc_id);
        // division,"-",DATE_FORMAT(created_at, "%y-%m"),"-",dc.id
        // dd($dc);
        $d_doc_created = Carbon::parse($dc->document_control->created_at);
        // $ctrl_num      = str_pad($dc->document_control->d_control_num,4,0, STR_PAD_LEFT);
        $ctrl_num = $dc->document_control->control_num;
        // $ctrl_num      = $dc->document_control->division.'-'.$d_doc_created->format('y-d').'-'.$ctrl_num;
        // dd($ctrl_num);
        // dd($dc->document_control->division.'-'.Carbon::parse($dc->document_control->created_at)->format('y-d').'-'.$ctrl_num);

        $name  = $this->makeInitialsFromName($dc->user->first_name." ".$dc->user->middle_name);
        $name .= $this->makeInitialsFromLastname($dc->user->last_name);

        $dc_slip = (object) [
            'name'     => $name,
            'ctrl_num' => $ctrl_num,
            'date_created'     => $d_doc_created->format('M d, y')
        ];
        // dd($dc_slip);
        // $code = "SMSUKARNO";
        // $qr = "";
        // dd($_SERVER["DOCUMENT_ROOT"]);
        // dd();
        // dd(asset('img/dosticon.png'));
        // $qr = base64_encode(QrCode::format('png')->size(200)->errorCorrection('H')->generate('string'));
        // $qr = base64_encode(QrCode::format('png')->merge('http://localhost:8000/img/dosticon.png', 0.3, true)
        //     ->size(200)->errorCorrection('H')
        //     ->generate('W3Adda Laravel Tutorial'));
        // $qr = QrCode::format('png')->merge('http://iamindore.com/w3newdesign/w3a/wp-content/uploads/2019/07/laravel.png', 0.3, true)
        //     ->size(200)->errorCorrection('H')
        //     ->generate('W3Adda Laravel Tutorial');
        // return view('d_tracking.print_document_slip', compact('code'));
        $pdf = PDF::loadView('d_tracking.print_document_slip', compact('dc_slip', 'qr'));
        return $pdf->stream();
    }
}
