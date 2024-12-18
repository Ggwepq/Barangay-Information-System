<?php
namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResidentAccountController extends Controller
{
    // Display a list of all resident users
    public function index()
    {
        $post = User::where('userRole', 3)->get();
        return view('Resident.Account.index', compact('post'));
    }

    // Show form to create a new resident user
    public function create()
    {
        $residents = Resident::whereDoesntHave('user')
            ->whereDoesntHave('officer')
            ->get();
        return view('Resident.Account.create', compact('residents'));
    }

    protected function stored() {}

    // Store a new resident user
    public function store(Request $request)
    {
        $rules = [
            'residentId' => 'required|unique:users,residentId',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'residentId' => $request->residentId,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userRole' => 3,
        ]);

        return redirect()->route('residents.index')->with('success', 'Resident account created successfully.');
    }

    // Show form to edit an existing resident user
    public function edit($id)
    {
        $user = User::where('userRole', 3)->findOrFail($id);  // Ensure it's a resident user
        return view('Residents.Account.edit', compact('user'));
    }

    // Update an existing resident user
    public function update(Request $request, $id)
    {
        $rules = [
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('Residents.Account.index')->with('success', 'Resident account updated successfully.');
    }

    // Delete a resident user
    public function destroy($id)
    {
        $user = User::where('userRole', 3)->findOrFail($id);
        $user->delete();
        return redirect()->route('Residents.Account.index')->with('success', 'Resident account deleted successfully.');
    }
}
