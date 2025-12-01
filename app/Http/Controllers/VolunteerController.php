<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = \App\Models\Volunteer::latest()->get();

        $stats = [
            'total_volunteers' => \App\Models\Volunteer::count(),
            'active_volunteers' => \App\Models\Volunteer::active()->count(),
            'volunteer_hours_this_month' => 0, // Placeholder until hours tracking is implemented
        ];

        return view('volunteers.index', compact('volunteers', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('volunteers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'join_date' => 'required|date',
            'skills' => 'nullable|string',
            'areas_of_interest' => 'nullable|string',
            'availability' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        \App\Models\Volunteer::create($validated);

        return redirect()->route('volunteers.index')->with('success', 'Volunteer added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $volunteer = \App\Models\Volunteer::findOrFail($id);
        return view('volunteers.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = \App\Models\Volunteer::findOrFail($id);
        return view('volunteers.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $volunteer = \App\Models\Volunteer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'join_date' => 'required|date',
            'skills' => 'nullable|string',
            'areas_of_interest' => 'nullable|string',
            'availability' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $volunteer->update($validated);

        return redirect()->route('volunteers.index')->with('success', 'Volunteer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $volunteer = \App\Models\Volunteer::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('volunteers.index')->with('success', 'Volunteer deleted successfully!');
    }
}
