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
use App\Models\Setting;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    protected $rules = [
        'firstName' => ['required', 'max:70', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
        'middleName' => ['nullable', 'max:20', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
        'lastName' => ['required', 'max:50', 'regex:/^[^~`!@#*_={}|\;<>,?()$%&^]+$/'],
        'house_no' => 'required|integer',
        'street' => 'required|max:70',
        'brgy' => 'required|max:50',
        'city' => 'required|max:50',
        'gender' => 'required',
        'province' => 'nullable|max:100',
        'citizenship' => 'required',
        'religion' => 'required|max:50',
        'birthdate' => 'required',
        'birthPlace' => 'required|max:100',
        'age' => 'required|integer',
        'civilStatus' => 'required',
        'occupation' => 'nullable|max:50',
        'image' => 'image|mimes:jpeg,png,jpg,svg',
        'contactNumber' => ['required', 'regex:/^[^_]+$/'],
        'created_at' => 'required',
        'motherFirstName' => 'nullable|max:70',
        'motherMiddleName' => 'nullable|max:20',
        'motherLastName' => 'nullable|max:50',
        'fatherFirstName' => 'nullable|max:70',
        'fatherMiddleName' => 'nullable|max:20',
        'fatherLastName' => 'nullable|max:50',
        'email' => 'required|email',
        'password' => 'required'  // Changed to required for create, nullable for update
    ];

    protected $messages = [
        'unique' => ':attribute already exists.',
        'required' => 'The :attribute field is required.',
        'max' => 'The :attribute field must be no longer than :max characters.',
        'regex' => 'The :attribute must not contain special characters.'
    ];

    protected $niceNames = [
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
        'age' => 'Age',
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

    public function index(Request $request)
    {
        $query = Resident::query();
        $query->where('isActive', 1);
        $civilStatus = Resident::distinct()->pluck('civilStatus');
        $religions = Resident::distinct()->pluck('religion');
        $occupations = Resident::distinct()->pluck('occupation');

        // dd(Resident::all()[0]->userofficer, Resident::first()->officer->first()->user->first()->email);

        // List of filters to apply
        $filters = [
            'name' => function ($query, $value) {
                $query->where(function ($q) use ($value) {
                    $q
                        ->where('firstName', 'like', '%' . $value . '%')
                        ->orWhere('middleName', 'like', '%' . $value . '%')
                        ->orWhere('lastName', 'like', '%' . $value . '%');
                });
            },
            'gender' => fn($query, $value) => $query->where('gender', $value),
            'min_age' => fn($query, $value) => $query->where('age', '>=', $value),
            'max_age' => fn($query, $value) => $query->where('age', '<=', $value),
            'civil_status' => fn($query, $value) => $query->where('civilStatus', $value),
            'blotter' => fn($query, $value) => $query->where('isDerogatory', $value),
            'isPWD' => fn($query, $value) => $query->where('isPWD', $value),
            'is4Ps' => fn($query, $value) => $query->where('is4Ps', $value),
            'religion' => fn($query, $value) => $query->where('religion', 'like', '%' . $value . '%'),
            'occupation' => function ($query, $value) {
                if ($value === 'Unemployed') {
                    $query->whereNull('occupation');
                } else {
                    $query->where('occupation', 'like', '%' . $value . '%');
                }
            },
        ];

        // Apply filters
        foreach ($filters as $field => $filter) {
            if ($request->filled($field)) {
                $filter($query, $request->get($field));
            }
        }

        $post = $query->get();

        return view('Resident.index', compact('post', 'civilStatus', 'religions', 'occupations'));
    }

    public function index2()
    {
        return view('Non-resident.index', ['post' => Resident::where('isActive', 1)->where('isRegistered', 0)->get()]);
    }

    public function create()
    {
        $post = Setting::first();
        $religions = Resident::distinct()->pluck('religion');
        $occupations = Resident::distinct()->pluck('occupation');
        return view('Resident.create', compact('religions', 'occupations', 'post'));
    }

    public function soft()
    {
        return view('Resident.soft', ['post' => Resident::where('isActive', 0)->get()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        $validator->setAttributeNames($this->niceNames);
        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();

        DB::beginTransaction();
        try {
            $pic = $this->saveImage($request);

            $resident = Resident::create(array_merge($request->all(), ['image' => $pic]));
            ResidentParent::create(array_merge($request->only(['motherFirstName', 'motherMiddleName', 'motherLastName', 'fatherFirstName', 'fatherMiddleName', 'fatherLastName']), ['residentId' => $resident->id]));
            User::create(array_merge($request->only(['email', 'password']), ['residentId' => $resident->id, 'password' => bcrypt($request->password), 'userRole' => 3]));

            if ($request->filled('voterId'))
                Voter::create(array_merge($request->only(['voterId', 'precintNo']), ['residentId' => $resident->id]));

            $this->sendNotification($resident, $request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('/admin/Resident')->withSuccess('Successfully inserted.');
    }

    public function sendNotification($resident, $request, $create = true)
    {
        $method = Setting::first()->notification_method;
        if ($create) {
            if ($method == 'EMAIL') {
                $fullName = $resident->firsName . ' ' . $resident->lastName;
                (new EmailController)->sendAccountCreatedMail($request->email, $fullName, $request->email, $request->password);
            } else {
                (new SMSController)->accountCreated($resident->contactNumber, ['residentName' => $resident->firstName, 'email' => $resident->email, 'password' => $request->password]);
            }
        } else {
            if ($method == 'EMAIL') {
                (new EmailController)->sendAccountUpdatedMail($resident['email'], $resident['residentName'], $resident['email'], $resident['password'] ?? null);
            } else {
                (new SMSController)->accountUpdated($request->contactNumber, $resident);
            }
        }
    }

    public function edit($id)
    {
        $post = Resident::find($id);
        $occupations = Resident::whereNotNull('occupation')->where('occupation', '!=', $post->occupation)->distinct()->pluck('occupation');
        $religions = Resident::whereNotNull('religion')->where('religion', '!=', $post->religion)->distinct()->pluck('religion');
        $user = User::where('officerId', $id)->first();
        $user = $user ? $user : User::where('residentId', $id)->first();
        return view('Resident.update', compact('post', 'user', 'occupations', 'religions'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $this->rules['password'] = 'nullable';  // Allow password update or skip
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        $validator->setAttributeNames($this->niceNames);

        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();

        DB::beginTransaction();
        try {
            $pic = $this->saveImage($request, $id);
            $res = Resident::find($id);

            $resident = $res->update(array_merge($request->except('password'), ['image' => $pic]));  // Remove password from update
            $this->updateRelatedRecords($request, $id);
            $account = array_merge(['residentName' => $request->firstName, 'email' => $request->email], ($request->filled('password')) ? ['password' => $request->password] : []);

            $this->sendNotification($account, $res, false);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('/admin/Resident')->withSuccess('Successfully updated.');
    }

    public function destroy($id)
    {
        Resident::find($id)->update(['isActive' => 0]);
        return redirect('/admin/Resident')->withSuccess('Successfully Deactivated.');
    }

    public function reactivate($id)
    {
        Resident::find($id)->update(['isActive' => 1]);
        return redirect('/admin/Resident/Soft')->withSuccess('Successfully Reactivated.');
    }

    public function remove($id)
    {
        $post = Resident::find($id);
        $checks = [Inhabitant::class, Blotter::class, Business::class, Schedule::class, Officer::class];
        foreach ($checks as $check) {
            if ($check::where('residentId', $id)->count() > 0) {
                return redirect('/admin/Resident')->withError('Record in use. Deletion failed.');
            }
        }
        if ($post->ResidentParents()->count())
            $post->ResidentParents()->delete();
        if ($post->Voter()->count())
            $post->Voter()->delete();
        $post->delete();
        return redirect('/admin/Resident/Soft');
    }

    private function saveImage(Request $request, $id = null)
    {
        $file = $request->file('image');
        if (!$file)
            return $id ? Resident::find($id)->image : 'img/uploads/steve.jpg';
        $date = date('Ymdhis');
        $extension = $file->getClientOriginalExtension();
        $pic = 'img/uploads/' . $date . '.' . $extension;
        $file->move('uploads', $pic);
        return $pic;
    }

    private function updateRelatedRecords($request, $id)
    {
        $chkResidentParent = DB::table('residents')->join('parents', 'parents.residentId', 'residents.id')->where('residents.id', $id)->count();

        if ($chkResidentParent > 0)
            ResidentParent::where('residentId', $id)->update($request->only(['motherFirstName', 'motherMiddleName', 'motherLastName', 'fatherFirstName', 'fatherMiddleName', 'fatherLastName']));
        else
            ResidentParent::create(array_merge($request->only(['motherFirstName', 'motherMiddleName', 'motherLastName', 'fatherFirstName', 'fatherMiddleName', 'fatherLastName']), ['residentId' => $id]));

        $chkVoter = DB::table('residents')->join('voters', 'voters.residentId', 'residents.id')->where('residents.id', $id)->count();
        $voterData = $request->only(['voterId', 'precintNo']);
        if ($chkVoter > 0) {
            Voter::where('residentId', $id)->update($voterData);
        } else if ($request->filled('voterId')) {
            Voter::create(array_merge($voterData, ['residentId' => $id]));
        }
        User::where('residentId', $id)->update(array_merge($request->only(['email']), ($request->filled('password')) ? ['password' => bcrypt($request->password)] : []));
    }
}
