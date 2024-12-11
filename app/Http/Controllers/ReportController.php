<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Officer;
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
        $civilStatus = Resident::distinct()->pluck('civilStatus');
        $religions = Resident::distinct()->pluck('religion');
        $occupations = Resident::distinct()->pluck('occupation');
        $status = Blotter::distinct()->pluck('status');
        $officers = Officer::all();

        return view('Report.index', compact('civilStatus', 'religions', 'occupations', 'status', 'officers'));
    }

    public function table(Request $request)
    {
        if ($request->source == 'blotters') {
            $data = $this
                ->blotterQuery($request)
                ->from('blotters as b')
                ->join('residents as complainant', 'complainant.id', '=', 'b.complainant')
                ->join('residents as complained', 'complained.id', '=', 'b.complainedResident')
                ->join('officers as inCharge', 'inCharge.id', '=', 'b.officerCharge')
                ->join('positions as pos', 'pos.id', '=', 'inCharge.positionId')
                ->whereBetween('b.created_at', [$request->from_date, $request->end_date])
                ->select(
                    'b.id',
                    DB::raw('CONCAT(complainant.firstName," ", complainant.lastName) AS complainant'),
                    DB::raw('CONCAT(complained.lastName," ", complained.firstName) AS complained_resident'),
                    'b.created_at as date',
                    'pos.position_name as officer',
                    'b.status',
                )
                ->get();
        } else if ($request->source == 'residents') {
            $residents = $this->residentQuery($request);
            $data = $residents
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
                );
        }

        $datatable = Datatables::of($data)
            ->addIndexColumn();

        if ($request->source == 'blotters') {
            $datatable->editColumn('status', function ($row) {
                $statusLabels = [
                    1 => 'Pending',
                    2 => 'Ongoing',
                    3 => 'Resolved',
                    4 => 'Filed to Action',
                ];
                return $statusLabels[$row->status] ?? 'Unknown';
            });
        } else {
            $datatable->editColumn('gender', function ($row) {
                $genderLabel = [
                    1 => 'Male',
                    2 => 'Female',
                ];
                return $genderLabel[$row['gender']] ?? 'Other';
            });

            $datatable->addColumn('occupation', function ($row) {
                return $row->occupation ?? 'Unemployed';
            });
        }

        return $datatable->make(true);
    }

    public function blotterQuery(Request $request)
    {
        $query = Blotter::query();

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

        return $query;
    }

    public function residentQuery(Request $request)
    {
        $query = Resident::query();

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

        return $query->get();
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
