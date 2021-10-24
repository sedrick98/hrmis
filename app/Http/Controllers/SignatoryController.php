<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\DivisionSection;
use App\Models\Signatory;
use App\Models\User;

class SignatoryController extends Controller
{
    public function divisions(Request $request) {
        if ($request->isMethod('get')) {
            return view('signatories.divisions', [
                'divisions' => Division::all()
            ]);
        }

        if ($request->isMethod('post')) {
            $division = Division::create([
                'name' => $request->name,
                'abbr' => $request->abbr,
                'active' => 1,
            ]);

            return redirect()->route('signatory-divisions');
        }
    }

    public function sections(Request $request) {
        if ($request->isMethod('get')) {
            return view('signatories.sections',[
                'divisions' => Division::all(),
                'sections' => DivisionSection::all(),
            ]);
        }

        if ($request->isMethod('post')) {
            // dd($request);
            $divisionSection = DivisionSection::create([
                'division_id' => $request->division,
                'name' => $request->name,
                'abbr' => $request->abbr,
                'office_site' => $request->office_site,
            ]);

            return redirect()->route('signatory-sections');
        }
    }

    public function assignments(Request $request) {
        if ($request->isMethod('get')) {
            return view('signatories.assign', [
                'users' => User::all(),
                'divisions' => Division::all(),
                'sections' => DivisionSection::all(),
            ]);
        }

        if ($request->isMethod('post')) {
            if (Signatory::where('user_id', $request->user_id)->count() != 0) {
                // has record
                $signatory = Signatory::where('user_id', $request->user_id)->first();
                $signatory->division_section_id = $request->section;
                $signatory->save();
            } else {
                // no record
                Signatory::create([
                    'user_id' => $request->user_id,
                    'division_section_id' => $request->section,
                ]);
            }

            return redirect()->route('signatory-assignments');
        }
    }
}
