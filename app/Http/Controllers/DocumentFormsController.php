<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dt_document_form;
use App\Traits\Module;

class DocumentFormsController extends Controller
{
    use Module;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = dt_document_form::orderBy('active', 'DESC')->orderBy('name', 'ASC')->get();
        // dd($d[0]->user->last_name);
        return view('document_form.create', compact('d'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = new dt_document_form;
        $d->added_by_user = auth()->user()->id;
        $d->name = request()->doc_name;
        $d->save();
        
        return redirect('document/form_type')->with('success', 'Successfully Added!');
    }

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
        //
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
        if(auth()->user()->hasPermission('make-active-document')) {
            $id = $this->reHash(request()->input('make_active'));
            
            $df = dt_document_form::findOrFail($id);
            $df->active = 1;
            $df->save();
        }else {
            abort(404);
        }
        return redirect('document/form_type')->with('success', 'Document Active!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
