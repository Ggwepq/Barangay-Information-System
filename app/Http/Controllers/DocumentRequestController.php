<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Resident;
use App\Models\Setting;
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

            $this->sendNotification($resident, $documentRequest);

            return redirect()->back()->with('success', 'Document request updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update document request. Please try again.');
        }
    }

    public function sendNotification($resident, $documentRequest)
    {
        $method = Setting::first()->notification_method;
        if ($method == 'EMAIL') {
            (new EmailController)->sendDocumentMail(
                $resident->user->email,
                $documentRequest->document_type,
                $documentRequest->status,
            );
        } else {
            (new SMSController)->documentActioned($resident->contactNumber, $documentRequest->document_type, $documentRequest->status);
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

    public function viewGenerateForUser(Request $request)
    {
        $query = Resident::query();
        $civilStatus = Resident::distinct()->pluck('civilStatus');
        $religions = Resident::distinct()->pluck('religion');
        $occupations = Resident::distinct()->pluck('occupation');

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

        return view('RequestDoc.generate-user', compact('post', 'civilStatus', 'religions', 'occupations'));
    }

    // Admin viewing all requests
    public function viewPendingRequests(Request $request)
    {
        $query = DocumentRequest::query();
        $query->where('status', 'Pending');

        $types = DocumentRequest::distinct()->pluck('document_type');
        $purposes = DocumentRequest::distinct()->pluck('purpose');

        // List of filters to apply
        $filters = [
            'type' => fn($query, $value) => $query->where('document_type', 'like', '%' . $value . '%'),
            'purpose' => fn($query, $value) => $query->where('purpose', 'like', '%' . $value . '%'),
        ];

        // Apply filters
        foreach ($filters as $field => $filter) {
            if ($request->filled($field)) {
                $filter($query, $request->get($field));
            }
        }

        $requests = $query->get();

        return view('RequestDoc.index', compact('requests', 'types', 'purposes'));
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
