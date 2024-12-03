<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Business;
use App\Models\Inhabitant;
use App\Models\Officer;
use App\Models\Resident;
use App\Models\ResidentParent;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Resident::where('isActive', 1)->where('isRegistered', 1)->get();
        return view('Resident.index', compact('post'));
    }

    public function index2()
    {
        $post = Resident::where('isActive', 1)->where('isRegistered', 0)->get();
        return view('Non-resident.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Resident.create');
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
            'firstName' => ['required', 'max:70', 'unique:residents', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable', 'max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required', 'max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'house_no' => 'required',
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable', 'regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'house_no' => 'House Number',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                $file = $request->file('image');
                $pic = '';
                if ($file == '' || $file == null) {
                    $pic = 'img/steve.jpg';
                } else {
                    $date = date('Ymdhis');
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $pic = 'img/' . $date . '.' . $extension;
                    $request->file('image')->move('img', $pic);
                    // $request->file('photo')->move(public_path("/uploads"), $newfilename);
                }

                $resident = Resident::create([
                    'firstName' => $request->firstName,
                    'middleName' => $request->middleName,
                    'lastName' => $request->lastName,
                    'house_no' => $request->house_no,
                    'street' => $request->street,
                    'brgy' => $request->brgy,
                    'city' => $request->city,
                    'gender' => $request->gender,
                    'province' => $request->province,
                    'citizenship' => $request->citizenship,
                    'religion' => $request->religion,
                    'birthdate' => $request->birthdate,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'occupation' => $request->occupation,
                    'isPWD' => $request->pwd,
                    'is4Ps' => $request->fourps,
                    'image' => $pic,
                    'contactNumber' => $request->contactNumber,
                    'created_at' => $request->created_at
                ]);

                ResidentParent::create([
                    'residentId' => $resident->id,
                    'motherFirstName' => $request->motherFirstName,
                    'motherMiddleName' => $request->motherMiddleName,
                    'motherLastName' => $request->motherLastName,
                    'fatherFirstName' => $request->fatherFirstName,
                    'fatherMiddleName' => $request->fatherMiddleName,
                    'fatherLastName' => $request->fatherLastName,
                ]);

                User::create([
                    'residentId' => $resident->id,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'userRole' => 3,
                ]);

                if ($request->filled('voterId')) {
                    Voter::create([
                        'residentId' => $resident->id,
                        'voterId' => $request->voterId,
                        'precintNo' => $request->precintNo
                    ]);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }

            return redirect('/admin/Resident')->withSuccess('Successfully inserted into the database.');
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
        $post = Resident::find($id);
        $user = User::all()->find($id);

        if ($user->officer)
            $user = User::where('officerId', $id)->first();
        else
            $user = User::where('residentId', $id)->first();

        return view('Resident.update', compact('post', 'user'));
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
        // dd($request);
        $rules = [
            'firstName' => ['required', 'max:70', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'middleName' => ['nullable', 'max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'lastName' => ['required', 'max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
            'house_no' => 'required',
            'street' => 'required|max:70',
            'brgy' => 'required|max:50',
            'city' => 'required|max:50',
            'gender' => 'required',
            'province' => 'nullable|max:100',
            'citizenship' => 'required',
            'religion' => 'required|max:50',
            'birthdate' => 'required',
            'birthPlace' => 'required|max:100',
            'civilStatus' => 'required',
            'occupation' => 'nullable|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,svg',
            'contactNumber' => ['nullable', 'regex:/^[^_]+$/'],
            'created_at' => 'required',
            'motherFirstName' => 'nullable|max:70',
            'motherMiddleName' => 'nullable|max:20',
            'motherLastName' => 'nullable|max:50',
            'fatherFirstName' => 'nullable|max:70',
            'fatherMiddleName' => 'nullable|max:20',
            'fatherLastName' => 'nullable|max:50',
            'email' => 'required|email',
            'password' => 'nullable',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'
        ];
        $niceNames = [
            'firstName' => 'First Name',
            'middleName' => 'Middle Name',
            'lastName' => 'Last Name',
            'house_no' => 'House Number',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'gender' => 'Gender',
            'province' => 'Province',
            'citizenship' => 'Citizenship',
            'religion' => 'Religion',
            'birthdate' => 'Birthdate',
            'birthPlace' => 'Birthplace',
            'civilStatus' => 'Civil Status',
            'occupation' => 'Occupation',
            'image' => 'Image',
            'contactNumber' => 'Contact Number',
            'created_at' => 'Date of Registration',
            'motherFirstName' => 'Mother First Name',
            'motherMiddleName' => 'Mother Middle Name',
            'motherLastName' => 'Mother Last Name',
            'fatherFirstName' => 'Father First Name',
            'fatherMiddleName' => 'Father Middle Name',
            'fatherLastName' => 'Father Last Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            try {
                $file = $request->file('image');
                $pic = '';
                if ($file == '' || $file == null) {
                    $nullpic = Resident::find($id);
                    $pic = $nullpic->image;
                } else {
                    $date = date('Ymdhis');
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $pic = 'img/' . $date . '.' . $extension;
                    $request->file('image')->move('img', $pic);
                    // $request->file('photo')->move(public_path("/uploads"), $newfilename);
                }

                $resident = Resident::find($id)->update([
                    'firstName' => $request->firstName,
                    'middleName' => $request->middleName,
                    'lastName' => $request->lastName,
                    'house_no' => $request->house_no,
                    'street' => $request->street,
                    'brgy' => $request->brgy,
                    'city' => $request->city,
                    'gender' => $request->gender,
                    'province' => $request->province,
                    'citizenship' => $request->citizenship,
                    'religion' => $request->religion,
                    'birthdate' => $request->birthdate,
                    'birthPlace' => $request->birthPlace,
                    'civilStatus' => $request->civilStatus,
                    'occupation' => $request->occupation,
                    'isPWD' => $request->pwd,
                    'is4Ps' => $request->fourps,
                    'image' => $pic,
                    'created_at' => $request->created_at
                ]);

                $chkVoter = DB::table('residents as r')
                    ->join('voters as v', 'v.residentId', 'r.id')
                    ->select('r.*')
                    ->where('r.id', $id)
                    ->get();

                $chkResidentParent = DB::table('residents as r')
                    ->join('parents as p', 'p.residentId', 'r.id')
                    ->select('r.*')
                    ->where('r.id', $id)
                    ->get();

                if (count($chkResidentParent) != 0) {
                    ResidentParent::find($request->parentid)->updateOrCreate([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }

                if (count($chkResidentParent) == 0) {
                    ResidentParent::create([
                        'residentId' => $request->residentId,
                        'motherFirstName' => $request->motherFirstName,
                        'motherMiddleName' => $request->motherMiddleName,
                        'motherLastName' => $request->motherLastName,
                        'fatherFirstName' => $request->fatherFirstName,
                        'fatherMiddleName' => $request->fatherMiddleName,
                        'fatherLastName' => $request->fatherLastName,
                    ]);
                }

                if ($request->password) {
                    User::all()->find($id)->update([
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]);
                } else {
                    User::all()->find($id)->update([
                        'email' => $request->email,
                    ]);
                }

                if ($request->filled('voterId')) {
                    if (count($chkVoter) == 0) {
                        Voter::create([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }

                    if (count($chkVoter) != 0) {
                        Voter::find($request->vId)->updateOrCreate([
                            'residentId' => $request->residentId,
                            'voterId' => $request->voterId,
                            'precintNo' => $request->precintNo
                        ]);
                    }
                }
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                $errMess = $e->getMessage();
                return Redirect::back()->withErrors($errMess);
            }
            return redirect('/admin/Resident')->withSuccess('Successfully updated into the database.');
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
        Resident::find($id)->update(['isActive' => 0]);
        return redirect('/admin/Resident');
    }

    public function soft()
    {
        $post = Resident::where('isActive', 0)->get();
        return view('Resident.soft', compact('post'));
    }

    public function reactivate($id)
    {
        Resident::find($id)->update(['isActive' => 1]);
        return redirect('/admin/Resident');
    }

    public function remove($id)
    {
        $post = Resident::find($id);

        $chkHousehold = Inhabitant::where('residentId', $id)->get();
        $chkBlotter = Blotter::where('complainant', $id)->orWhere('complainedResident', $id)->get();
        $chkBusiness = Business::where('residentId', $id)->get();
        $chkSchedule = Schedule::where('residentId', $id)->get();
        $chkOfficer = Officer::where('residentId', $id)->get();

        if (count($chkHousehold) > 0 || count($chkBlotter) > 0 || count($chkBusiness) > 0 || count($chkSchedule) > 0 || count($chkOfficer) > 0) {
            return redirect('/admin/Resident')->withError('It seems that the record is still being used in other items. Deletion failed.');
        } else {
            if (count($post->ResidentParents) != 0) {
                $parent = ResidentParent::where('residentId', $post->id)->first();
                $parent->delete();
            }

            if (count($post->Voter) != 0) {
                $voter = Voter::where('residentId', $post->id)->first();
                $voter->delete();
            }

            $post->delete();
            return redirect('/admin/Resident/Soft');
        }
    }
}
