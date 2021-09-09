<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class dt_document_routes extends Model
{
    //
    protected $primaryKey = 'dr_id';

    public function dt_documents() {
        return $this->belongsTo('App\dt_documents', 'd_id')->withDefault();
    }

    public function dt_control_num() {
        return $this->belongsTo('App\dt_document_control', 'd_id')->withDefault();
    }
    public function user() { 
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault();
        //return $this->belongsTo('App\Models\Access\User\User', 'route_user', 'id');
    }

    public function route_to_user() { 
        return $this->belongsTo('App\User', 'route_user', 'id')->withDefault();
    }

    public static function num_pending() {
        $d_routes = DB::table('dt_document_routes as dr')
                    ->join('dt_documents as d', 'dr.d_id', '=', 'd.d_id')
                    ->select(DB::raw('COUNT(*) as pending'))
                    ->where('route_user', auth()->user()->id)
                    ->where('d_is_received', 0)
                    ->where('d_is_forwarded', 0)
                    ->whereNull('deleted_at')
                    ->whereNull('closed_by_user')
                    ->get();
        
    // $d_routes = DB::table('dt_document_routes')
    //             ->select(DB::raw('COUNT(*) as pending'))
    //             ->where('route_user', auth()->user()->id)
    //             ->where('d_is_received', 0)
    //             ->whereNull('closed_by_user')
    //             ->get();
    return (count($d_routes) > 0) ? $d_routes[0]->pending:0;
    }
}
