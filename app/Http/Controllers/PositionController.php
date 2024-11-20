<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\Position;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Position::where('isActive', 1)->get();
        return view('Position.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::where('isActive', 1)->get();
        return view('Position.create', compact('resident'));
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
            'position_name' => ['required', 'unique:positions'],
            'position_limit' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'position_name' => 'Position Name',
            'position_limit' => 'Position Limit',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                Position::create([
                    'position_name' => $request->position_name,
                    'position_limit' => $request->position_limit,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/admin/Position')->withSuccess('Successfully inserted into the database.');
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
        $position = Resident::where('isActive', 1)->get();
        $post = Position::where('isActive', 1)->get();
        $post = Officer::with('User')->find($id);
        return view('Position.update', compact('resident', 'post'));
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
            'position_name' => ['required', Rule::unique('positions')->ignore($id)],
            'position_limit' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'position_name' => 'Position Name',
            'position_limit' => 'Position Limit',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                $position = Position::find($id)->update([
                    'position_name' => $request->position_name,
                    'position_limit' => $request->position_limit,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/admin/Position')->withSuccess('Successfully inserted into the database.');
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
        Position::find($id)->update(['isActive' => 0]);
        return redirect('/admin/Position');
    }

    public function soft()
    {
        $post = Position::where('isActive', 0)->get();
        return view('Position.soft', compact('post'));
    }

    public function reactivate($id)
    {
        Position::find($id)->update(['isActive' => 1]);
        return redirect('/admin/Position');
    }

    public function remove($id)
    {
        try {
            // Attempt to delete the position
            $position = Position::findOrFail($id);
            $position->delete();

            return redirect()->back()->with('success', 'Position deleted successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {  // SQLSTATE 23000 for foreign key violations
                return redirect()->back()->with('error', 'Cannot delete this position because it is assigned to officers.');
            }

            // For other database errors
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
}
