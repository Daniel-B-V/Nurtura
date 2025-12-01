<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('settings.index', compact('user'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        // Store in session or database as needed
        session()->put('organization_settings', $validated);

        return back()->with('success', 'General settings updated successfully!');
    }

    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'donation_alerts' => 'boolean',
            'inventory_alerts' => 'boolean',
            'child_updates' => 'boolean',
        ]);

        // Store in session or database as needed
        session()->put('notification_settings', $validated);

        return back()->with('success', 'Notification settings updated successfully!');
    }

    public function updateSecurity(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
