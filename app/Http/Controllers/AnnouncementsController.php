<?php

namespace App\Http\Controllers;

use App\Jobs\SendSMSNotification;
use App\Models\Announcement;
use App\Models\Resident;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', 1)->get();

        // dd($announcements->first());
        return view('Announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('Announcement.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            $announcement = Announcement::create([
                'title' => $request->title,
                'content' => $request->content,
                'created_by' => auth()->user()->officerId,
            ]);

            return redirect('/admin/announcement')->withSuccess('Announcement Created Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to create Announcement. Please try again.');
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement created and users notified!');
    }

    public function list()
    {
        $announcements = Announcement::where('is_active', true)->get();
        // dd($announcements->first()->users->officer->position->position_name);
        return view('User.Announcement.index', compact('announcements'));
    }

    public function announce($id)
    {
        $announce = Announcement::findOrFail($id);

        // Change this to true to announce to all, Sending to all can have some issue.
        $all = false;

        // Default Number
        $number = $all ? Resident::where('isActive', 1)->pluck('contactNumber') : '09916759759';
        $email = $all ? User::where('residentId', '!=', 'null')->pluck('email') : 'abaloyan_johncedric@spcc.edu.ph';

        $this->sendNotification($announce, $email, $number);

        return redirect()->back()->withSuccess('Successfully Announced.');
    }

    public function sendNotification($announce, $email = null, $number = null)
    {
        $method = Setting::first()->notification_method;

        if ($method == 'EMAIL') {
            (new EmailController)->sendAnnouncementMail($email, $announce->title, $announce->content);
        } else {
            (new SMSController)->notifyAnnouncement($number, $announce->title);
        }
    }

    public function remove($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->delete();

            return redirect('/admin/announcement')->withSuccess('Announcement successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Announcement. Please try again.');
        }
    }
}
