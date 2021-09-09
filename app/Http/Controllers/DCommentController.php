<?php

namespace App\Http\Controllers;


use App\dt_document_comment;
use App\dt_documents;
// use App\dt_document_comment_seen;
use App\Notifications\DocumentComment;
// use Notification;
use Auth;
use Illuminate\Http\Request;
use Crypt;
use DB;
use App\User;

class DCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $collection = collect([
        //     ['account_id' => 'account-x10', 'product' => 'Chair'],
        //     ['account_id' => 'account-x10', 'product' => 'Bookcase'],
        //     ['account_id' => 'account-x11', 'product' => 'Desk'],
        // ]);
        // dd($collection);
        // $grouped = $collection->groupBy('account_id');

        // dd($grouped);
        // $d = dt_documents::find(11);
        
        // dd($d->document_control->control_num);
        // $c = new dt_document_comment;
        // $c->id = 9;
        // dd($c);
        // $c = collect(new dt_document_comment);
        // dd($c);
// App\dt_document_comment
        // $u = Auth::user()->unreadNotifications;
        // $u = dt_document_comment::selectRaw('uid_comment as id')->where('uid_comment', 11)->where('d_id',11)->get();
        // $u[] = $c;
        // $u[] = (object) ['dt_document_comment'=> ['id'=>97]];
        // dd($u);
        // $notifications = auth()->user()->unreadNotifications;
        // $c = new dt_document_comment;
        // $c = dt_document_comment::selectRaw('uid_comment as id')->where('uid_comment', 11)->where('d_id',11)->first();

        /*$c = new dt_document_comment;
        $c->id = 97;

        $notif = $c->notifications->groupBy(function($data) {
            return $data["data"]["Comment"]["d_id"];
        });
        // dd($notif);
        $test = array();
        foreach ($notif as $key => $value) {
            dd($value->first());
            dd($value[0]->data['Comment']['control_num']);
            $test[] = $key;
            // dd($n);
        }*/
        // $notif = $c->notifications>groupBy(function($data) {
        //     return $data["albumId"];
        // });
        // dd($test);
//         $u = User::limit(1)->pluck('id')->toArray();
// // dd($u);
//         $dc = dt_document_comment::selectRaw('uid_comment as id')->where('d_id', 11)->groupBy('uid_comment')->get();
//         // dd($dc);
//         // $u = User::find($dc);
        // \Notification::send($u, new DocumentComment());
//         dd($dc);
//         // dt_document_comment::where()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        DB::beginTransaction();
        try {
            $did = \Crypt::decrypt($id);
            $notif = array();
            $uc              = New dt_document_comment;
            $uc->d_id        = $did;
            $uc->uid_comment = Auth::user()->id;
            $uc->comment     = request()->dcomment;
            $uc->save();

            $d = dt_documents::find($did);
            
            if($d->uid==Auth::user()->id) { // Sya ang nag create sa document then notify users na nag comment sa iyahang document
                $notif = dt_document_comment::selectRaw('uid_comment as id')->where('d_id', $did)->where('uid_comment',"!=",$d->uid)->groupBy('uid_comment')->get();
            } else { // 
                $c = new dt_document_comment;
                $c->id = $d->uid;
                $notif = $c;
            }   
            
            if(count($notif)>0) {
                $uc->control_num = $d->document_control->control_num;
                $uc->url = 'document/view/'.$id;
                \Notification::send($notif, new DocumentComment($uc));
            }
            
            // $cs = new dt_document_comment_seen;
            // dt_document_comment::where()->get();
            // $u = User::limit(1)->pluck('id')->toArray();
            // dd($u);
            
            // dd($dc);
            // $u = User::find($dc);
            DB::commit();
            return redirect('document/view/'.$id)->with('success', 'Comment Added!');
        } catch (\Exceptions $exception) {
            DB::rollBack();
            parent::report($exception);
        }
        DB::rollBack();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DCommentController  $dCommentController
     * @return \Illuminate\Http\Response
     */
    public function show(DCommentController $dCommentController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DCommentController  $dCommentController
     * @return \Illuminate\Http\Response
     */
    public function edit(DCommentController $dCommentController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DCommentController  $dCommentController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DCommentController $dCommentController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DCommentController  $dCommentController
     * @return \Illuminate\Http\Response
     */
    public function destroy(DCommentController $dCommentController)
    {
        //
    }
}
