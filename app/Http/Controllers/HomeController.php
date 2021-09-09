<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dt_documents;
use App\dt_document_form;
// use App\User;
use Auth;   
use DB;

class HomeController extends Controller
{
    public function dashboard() {
        $routed = dt_documents::where('uid', Auth::user()->id)->count();
        //dd($routed);
        $open = dt_documents::where('status', 'open')->where('uid', Auth::user()->id)->count();
        $close = dt_documents::where('status', 'closed')->where('uid', Auth::user()->id)->count();

        //dd($documents[0]->dt_type->name);
        //dd($documents[0]->dt_type->name);
        return view('dashboard.index', compact('routed', 'open', 'close'));
    }

    public function documents() {
        // $documents = DB::table('dt_documents as dt')
        // ->select(DB::raw('(SELECT name FROM dt_document_forms df WHERE df.df_id=dt.d_type) as name'),
        //         DB::raw('COUNT(*) as total')
        // )
        // ->groupBy('d_type')
        // ->orderBy('total', 'DESC')
        // ->get();
        
        // $documents = DB::table('dt_document_forms as df')
        //                 ->join('dt_documents as dt', 'dt.d_type', 'df.df_id')
        //                 ->select('df.name', DB::raw('COUNT(dt.d_type)'))
        //                 ->groupBy('dt.d_type')
        //                 ->orderBy('total')
        //                 ->get();
        // dd($documents);         
        // $docs = array();
        // foreach ($documents as $d) {
        //     $docs['forms'][]= $d->name;
        //     $docs['form_num'][] = $d->total;
        // }
        $docs = array();
        $sort_docs = array();
            
        if(request()->input('ch')=='dhbar') {
            $user_document = dt_documents::select('d_type', DB::raw('COUNT(*) as tcount'))->where('uid', Auth::user()->id)->groupBy('d_type')->get();
            
            foreach ($user_document as $ud) {
                $docs[] = array('form_name'=>$ud->dt_type->name, 'tcount'=>$ud->tcount);
            }

            usort($docs, function($a, $b) {
                return $b['tcount'] - $a['tcount'];
            });

            foreach ($docs as $d) {
                $sort_docs['forms'][]    = $d['form_name'];
                $sort_docs['form_num'][] = $d['tcount'];
            }
        } elseif(request()->input('ch')=='dpie') {
            $user_document = dt_documents::select('status', DB::raw('COUNT(*) as tcount'))->where('uid', Auth::user()->id)->groupBy('status')->orderBy('status', 'DESC')->get();
            foreach ($user_document as $ud) {
                // $docs[] = array('form_name'=>$ud->dt_type->name, 'tcount'=>$ud->tcount);
                $sort_docs['status'][] = $ud->status;
                $sort_docs['tcount'][] = $ud->tcount;
            }
        }
        
        /**
        $documents = dt_document_form::all();
        //$documents = dt_document_form::orderBy('name', 'DESC')->get();
        
        $docs = array();
        $sort_docs = array();
        foreach ($documents as $d) {
            //$docs['forms'][]= $d->name;
            //$docs['form_num'][] = $d->dt_documents->count();
            $docs[] = array('form_name'=>$d->name, 'tcount'=>$d->dt_documents->count());
            //$docs[] = array($d->dt_documents->count()=>$d->name);
            //$docs[] = (object) [$d->name=>$d->dt_documents->count()];
        }
        usort($docs, function($a, $b) {
            return $b['tcount'] - $a['tcount'];
        });
        //($docs);

        foreach ($docs as $d) {
            $sort_docs['forms'][]=$d['form_name'];
            $sort_docs['form_num'][] = $d['tcount'];
        }
       // dd($docs);
        //$data = array('july');
        */
        return response()->json($sort_docs);
    }
}
