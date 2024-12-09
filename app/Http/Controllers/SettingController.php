<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $post = Setting::all()->first();
        return view('Custom.settings', compact('post'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,svg',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay_name' => 'required|string',
            'zone' => 'required|string',
            'district' => 'required|string',
            'notification_method' => 'required|in:SMS,EMAIL',
        ]);

        $setting = Setting::first();
        $pic = $this->saveImage($request, $setting->id);

        $settings = $setting->update(array_merge($request->all(), ['logo' => $pic]));

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    private function saveImage(Request $request, $id = null)
    {
        $file = $request->file('logo');

        if (!$file) {
            return $id ? Setting::find($id)->logo : 'img/uploads/settings/logo.png';
        }

        $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = 'img/uploads/settings';  // Define the folder path

        $file->move(public_path($destinationPath), $filename);

        return $destinationPath . '/' . $filename;
    }
}
