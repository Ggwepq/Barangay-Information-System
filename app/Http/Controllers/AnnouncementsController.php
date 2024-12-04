<?php

namespace App\Http\Controllers;

use App\Jobs\SendSMSNotification;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', 1)->get();
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
                'created_by' => auth()->id(),
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
        return view('User.Announcements.index', compact('announcements'));
    }

    public function announce($id)
    {
        // Notify users via SMS
        $users = User::where('isActive', true)->get();
        foreach ($users as $user) {
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