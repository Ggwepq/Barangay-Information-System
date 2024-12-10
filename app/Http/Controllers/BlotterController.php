<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Officer;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlotterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Blotter::query();
        $query->where('isActive', 1);

        $officers = Officer::all();
        $status = Blotter::distinct()->pluck('status');

        // List of filters to apply
        $filters = [
            'status' => fn($query, $value) => $query->where('status', 'like', '%' . $value . '%'),
            'officer' => fn($query, $value) => $query->where('officerCharge', 'like', '%' . $value . '%'),
        ];

        // Apply filters
        foreach ($filters as $field => $filter) {
            if ($request->filled($field)) {
                $filter($query, $request->get($field));
            }
        }

        $post = $query->get();

        return view('Blotter.index', compact('post', 'status', 'officers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::where('isActive', 1)->get();
        $resident2 = Resident::where('isActive', 1)->orderBy('id', 'desc')->get();
        $officer = Officer::where('isActive', 1)->get();
        return view('Blotter.create', compact('resident', 'resident2', 'officer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id' => ['required', 'unique:blotters'],
            'complainant' => 'required',
            'complainedResident' => 'required',
            'officerCharge' => 'required',
            'description' => 'required|max:150',
            'created_at' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'id' => 'Case No.',
            'complainant' => 'Complainant',
            'complainedResident' => 'Complained Resident',
            'officerCharge' => 'Officer-in-Charge',
            'description' => 'Description',
            'created_at' => 'Date of Filing'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                Blotter::create([
                    'id' => $request->id,
                    'complainant' => $request->complainant,
                    'complainedResident' => $request->complainedResident,
                    'officerCharge' => $request->officerCharge,
                    'description' => $request->description,
                    'created_at' => $request->created_at
                ]);

                Resident::find($request->complainedResident)->update(['isDerogatory' => 0]);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }

            return redirect('/admin/Blotter')->withSuccess('Successfully inserted into the database.');
        }
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
        $post = Blotter::find($id);
        $resident = Resident::where('isActive', 1)->get();
        $resident2 = Resident::where('isActive', 1)->orderBy('id', 'desc')->get();
        $officer = Officer::where('isActive', 1)->get();
        return view('Blotter.update', compact('resident', 'resident2', 'post', 'officer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id' => ['required', Rule::unique('blotters')->ignore($id)],
            'complainant' => 'required',
            'complainedResident' => 'required',
            'officerCharge' => 'required',
            'description' => 'required|max:150',
            'created_at' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'id' => 'Case No.',
            'complainant' => 'Complainant',
            'complainedResident' => 'Complained Resident',
            'officerCharge' => 'Officer-in-Charge',
            'description' => 'Description',
            'created_at' => 'Date of Filing'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                DB::table('residents')->where('id', $request->complainant)->update(['isDerogatory' => 1]);
                DB::table('residents')->where('id', $request->complainedResident)->update(['isDerogatory' => 1]);

                Blotter::find($id)->update([
                    'id' => $request->id,
                    'complainant' => $request->complainant,
                    'complainedResident' => $request->complainedResident,
                    'officerCharge' => $request->officerCharge,
                    'description' => $request->description,
                    'status' => $request->status,
                    'created_at' => $request->created_at
                ]);

                Resident::find($request->complainedResident)->update(['isDerogatory' => 0]);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }

            return redirect('/admin/Blotter')->withSuccess('Successfully updated into the database.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blotter::find($id)->update(['isActive' => 0]);
        return redirect('/admin/Blotter');
    }

    public function soft()
    {
        $post = Blotter::where('isActive', 0)->get();
        return view('Blotter.soft', compact('post'));
    }

    public function reactivate($id)
    {
        Blotter::find($id)->update(['isActive' => 1]);
        return redirect('/admin/Blotter');
    }

    public function remove($id)
    {
        $post = Blotter::find($id);
        $post->delete();
        return redirect('/admin/Blotter/Soft');
    }
}
