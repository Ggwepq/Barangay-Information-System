<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Project;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Report.index');
    }

    public function table(Request $request)
    {
        if ($request->source == 'blotters') {
            $data = DB::table('blotters as b')
                ->join('residents as complainant', 'complainant.id', '=', 'b.complainant')
                ->join('residents as complained', 'complained.id', '=', 'b.complainedResident')
                ->whereBetween('b.created_at', [$request->from_date, $request->end_date])
                ->select(
                    'b.id',
                    DB::raw('CONCAT(complainant.firstName, ", ", complainant.lastName) AS complainant'),
                    DB::raw('CONCAT(complained.lastName, ", ", complained.firstName) AS complained_resident'),
                    'b.created_at as date'
                );
        } else if ($request->source == 'residents') {
            $data = DB::table('residents')
                ->whereBetween('created_at', [$request->from_date, $request->end_date])
                ->select(
                    'id',
                    'firstName',
                    'lastName',
                    'gender',
                    'age',
                    'civilStatus',
                    'religion',
                    'occupation',
                    'created_at as date'
                );
        }

        $datatable = Datatables::of($data)->addIndexColumn()->make(true);

        return $datatable;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($start, $end)
    {
        $post = Blotter::whereBetween('created_at', [$start, $end])->whereBetween('status', ['2', '4'])->get();
        $pdf = Pdf::loadView('Forms.BlotterReport', compact('post', 'start', 'end'));
        $pdf->SetPaper('letter', 'portrait');;
        return $pdf->stream();
    }
}
