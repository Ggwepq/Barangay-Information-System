<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Business;
use App\Models\Position;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $post = Resident::find($id);
        $position = Position::all();
        $cman = $position->where('position_name', 'Chairman')->first()->officer->first();
        $sec = $position->where('position_name', 'Secretary')->first()->officer->first();
        $pdf = PDF::loadView('Forms.BarangayClearance', compact('post', 'cman', 'sec'));

        $pdf->SetPaper('letter', 'portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function business($id)
    {
        $post = Business::find($id);
        $position = Position::all();
        $cman = $position->where('position_name', 'Chairman')->first()->officer->first();
        $sec = $position->where('position_name', 'Secretary')->first()->officer->first();
        $pdf = PDF::loadView('Forms.BusinessPermit', compact('post', 'cman', 'sec'));
        $pdf->SetPaper('letter', 'portrait');;
        return $pdf->stream();
    }

    public function indigency($id)
    {
        $post = Resident::find($id);
        $position = Position::all();
        $cman = $position->where('position_name', 'Chairman')->first()->officer->first();
        $sec = $position->where('position_name', 'Secretary')->first()->officer->first();
        $pdf = PDF::loadView('Forms.CertificateIndigency', compact('post', 'cman', 'sec'));
        $pdf->SetPaper('letter', 'portrait');;
        return $pdf->stream();
    }

    public function file($id)
    {
        $post = Blotter::find($id);
        $position = Position::all();
        $cman = $position->where('position_name', 'Chairman')->first()->officer->first();
        $sec = $position->where('position_name', 'Secretary')->first()->officer->first();
        $pdf = PDF::loadView('Forms.FiletoAction', compact('post', 'cman', 'sec'));
        $pdf->SetPaper('letter', 'portrait');
        return $pdf->stream();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
