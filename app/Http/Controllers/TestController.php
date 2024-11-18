<?php

// phpcs:ignoreFile

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Officer;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    public function index($id)
    {
        $post = Resident::find($id);
        $cman = Officer::where('position', 'Chairman')->first();
        $sec = Officer::where('position', 'Secretary')->first();
        return view('Forms.BarangayClearance', compact('post', 'cman', 'sec'));
    }

    public function fileToAction($id)
    {
        $post = Blotter::find($id);
        $cman = Officer::where('position', 'Chairman')->first();
        $sec = Officer::where('position', 'Secretary')->first();
        $pdf = Pdf::loadView('Forms.FiletoAction', compact('post', 'cman', 'sec'));
        return $pdf->stream();
    }

    public function testToAction($id)
    {
        $post = Blotter::find($id);
        $cman = Officer::where('position', 'Chairman')->first();
        $sec = Officer::where('position', 'Secretary')->first();
        $pdf = PDF::loadView('Forms.FiletoAction', compact('post', 'cman', 'sec'));
        return $pdf->stream();
    }
}
