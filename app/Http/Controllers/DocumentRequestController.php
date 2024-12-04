<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    // User requesting a document
    public function requestDocument(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|string|max:255',
            'purpose' => 'nullable|string',
        ]);

        // dd($validated);

        try {
            $documentRequest = DocumentRequest::create([
                'resident_id' => auth()->user()->residentId,  // Assuming user has residentId
                'document_type' => $validated['document_type'],
                'purpose' => $validated['purpose'],
                'requested_at' => now(),
                'status' => 'Pending',
            ]);

            return redirect('/user/document')->withSuccess('Document request submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to submit document request. Please try again.');
        }
    }

    // Admin reviewing a document request
    public function reviewRequest($id, Request $request)
    {
        $sms = new SMSController();

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        try {
            $documentRequest = DocumentRequest::findOrFail($id);
            $resident = $documentRequest->resident;

            $documentRequest->status = $validated['status'];

            $documentRequest->approved_at = now();
            if ($validated['status'] === 'Approved') {
                $documentRequest->expiration_date = Carbon::now()->addDays(7);  // Expiration in 1 day
            }

            $documentRequest->save();

            $sms->documentActioned($resident->contactNumber, $documentRequest->document_type, $documentRequest->status);
            return redirect()->back()->with('success', 'Document request updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update document request. Please try again.');
        }
    }

    // User viewing their requests
    public function viewRequests()
    {
        $requests = DocumentRequest::where('resident_id', auth()->user()->residentId)->get();

        return view('User.Document.index', compact('requests'));
    }

    // User viewing their requests
    public function createRequest()
    {
        return view('User.Document.create');
    }

    // Admin viewing all requests
    public function viewPendingRequests()
    {
        $requests = DocumentRequest::all()->where('status', 'Pending');

        return view('RequestDoc.index', compact('requests'));
    }

    // Admin viewing all requests
    public function viewActionedRequests()
    {
        $requests = DocumentRequest::all()->where('status', '!=', 'Pending');

        return view('RequestDoc.actioned', compact('requests'));
    }

    public function deleteRequest($id)
    {
        try {
            $documentRequest = DocumentRequest::findOrFail($id);
            $documentRequest->delete();

            return redirect('/user/document')->withSuccess('Request successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete document request. Please try again.');
        }
    }
}
