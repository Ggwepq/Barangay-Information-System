<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Resident;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $res = auth()->user()->resident;
        $announcements = Announcement::where('is_active', 1)->orderBy('created_at', 'desc')->take(4)->get();
        return view('User.home', compact('res', 'announcements'));
    }

    public function profile()
    {
        $post = auth()->user()->resident;
        $user = auth()->user();
        return view('User.Profile.index', compact('post', 'user'));
    }
}
