<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Officer;
use App\Models\Project;
use App\Models\Resident;
use App\Models\Voter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function homepage()
    {
        $user = Auth::user();

        if ($user->userRole == 1) {
            return redirect('/admin/');
        } else {
            return redirect('/user/home');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $voter = Voter::where('isActive', 1)->count();
        $male = Resident::where('isActive', 1)->where('gender', 1)->count();
        $female = Resident::where('isActive', 1)->where('gender', 2)->count();
        $employed = Resident::where('occupation', '!=', null)->count();
        $resident = Resident::where('isActive', 1)->count();
        $pwd = Resident::where('isPWD', 1)->count();
        $fourps = Resident::where('is4Ps', 1)->count();
        $record = Resident::where('isActive', 1)->where('isDerogatory', 0)->count();
        $recent = Resident::where('isActive', 1)->orderBy('created_at', 'desc')->take(8)->get();
        $officers = Officer::where('isActive', 1)->where('positionId', '!=', 3)->take(3)->get();
        $kagawad = Officer::where('positionId', 3)->first();
        $projects = Project::where('status', 2)->take(8)->get();
        $ageGroups = $this->ageGroups();
        $blotterStatus = $this->getBlotterStatus();

        $slider = [
            'maleSlider' => $this->percent($male, $resident) . '%',
            'femaleSlider' => $this->percent($female, $resident) . '%',
            'resRecord' => $this->percent($record, $resident) . '%',
            'pwdSlider' => $this->percent($pwd, $resident) . '%',
        ];

        return view('dashboard', compact('voter', 'male', 'female', 'resident', 'employed', 'pwd', 'fourps', 'recent', 'officers', 'kagawad', 'projects', 'ageGroups', 'record', 'slider', 'blotterStatus'));
    }

    private function percent($part, $whole)
    {
        return number_format(($part / $whole) * 100);
    }

    public function genders()
    {
        $male = Resident::where('isActive', 1)->where('gender', 1)->count();
        $female = Resident::where('isActive', 1)->where('gender', 2)->count();

        $genders = [
            'Male' => $male,
            'Female' => $female,
        ];

        return response()->json($genders);
    }

    public function ageGroups()
    {
        $ageGroups = Resident::selectRaw("
    CASE
        WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 18 THEN 'Minors'
        WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 18 AND 30 THEN 'Adult'
        WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 31 AND 60 THEN 'Middle Aged'
        WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 60 THEN 'Senior'
    END as age_group, COUNT(*) as count
")
            ->groupBy('age_group')
            ->get()
            ->keyBy('age_group');

        // Ensure all age groups exist with default values
        $defaultAgeGroups = collect([
            'Minors' => 0,
            'Adult' => 0,
            'Middle Aged' => 0,
            'Senior' => 0,
        ]);

        // Merge the default values with the actual results
        $ageGroups = $defaultAgeGroups->merge($ageGroups->mapWithKeys(function ($item) {
            return [$item['age_group'] => $item['count']];
        }));

        return $ageGroups;
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
    }

    public function blotterMonths()
    {
        $jan = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '01')->get());
        $feb = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '02')->get());
        $mar = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '03')->get());
        $apr = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '04')->get());
        $may = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '05')->get());
        $jun = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '06')->get());
        $jul = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '07')->get());
        $aug = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '08')->get());
        $sep = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '09')->get());
        $oct = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '10')->get());
        $nov = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '11')->get());
        $dec = count(Blotter::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', '12')->get());

        $response = Response()->json(['jan' => $jan, 'feb' => $feb, 'mar' => $mar, 'apr' => $apr, 'may' => $may, 'jun' => $jun, 'jul' => $jul, 'aug' => $aug, 'sep' => $sep, 'oct' => $oct, 'nov' => $nov, 'dec' => $dec]);

        return $response;
    }

    public function getBlotterStatus()
    {
        $total = Blotter::where('isActive', 1)->count();
        $filed = Blotter::where('isActive', 1)->where('status', 4)->count();
        $ongoing = Blotter::where('isActive', 1)->where('status', 2)->count();
        $resolved = Blotter::where('isActive', 1)->where('status', 3)->count();

        return [
            'total' => $total,
            'filed' => $filed,
            'ongoing' => $ongoing,
            'resolved' => $resolved,
        ];
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
