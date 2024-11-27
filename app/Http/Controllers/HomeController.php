<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Resident;
use App\Models\Voter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Blotter::where('isActive', 1)->where('status', 1)->get();
        $blotter = Blotter::where('isActive', 1)->where('status', 1)->get();
        $voter = Voter::where('isActive', 1)->get();
        $male = Resident::where('isActive', 1)->where('gender', 1)->get();
        $female = Resident::where('isActive', 1)->where('gender', 2)->get();
        $record = Resident::where('isActive', 1)->where('isDerogatory', 0)->get();
        $resident = Resident::where('isActive', 1)->get();

        return view('dashboard', compact('voter', 'blotter', 'post', 'male', 'female', 'record', 'resident'));
    }

    public function month()
    {
        $jan = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '01')->get());
        $feb = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '02')->get());
        $mar = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '03')->get());
        $apr = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '04')->get());
        $may = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '05')->get());
        $jun = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '06')->get());
        $jul = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '07')->get());
        $aug = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '08')->get());
        $sep = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '09')->get());
        $oct = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '10')->get());
        $nov = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '11')->get());
        $dec = count(Resident::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '12')->get());

        $response = Response()->json(['jan' => $jan, 'feb' => $feb, 'mar' => $mar, 'apr' => $apr, 'may' => $may, 'jun' => $jun, 'jul' => $jul, 'aug' => $aug, 'sep' => $sep, 'oct' => $oct, 'nov' => $nov, 'dec' => $dec]);

        return $response;
        // return Response()->json(['data'=>$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec);
    }

    public function error()
    {
        return view('errors.notauth');
    }

    public function error2()
    {
        return view('errors.notallowed');
    }
}
