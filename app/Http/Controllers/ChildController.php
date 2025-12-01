<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildHealthRecord;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Child::with(['healthRecords' => function($query) {
            $query->latest()->limit(1);
        }, 'educationRecords' => function($query) {
            $query->latest()->limit(1);
        }])
        ->orderBy('created_at', 'desc')
        ->get();

        // Calculate stats
        $totalChildren = Child::count();
        $goodHealthCount = Child::whereHas('healthRecords', function($query) {
            $query->where('status', 'good')->latest();
        })->count();
        $goodHealthPercentage = $totalChildren > 0 ? round(($goodHealthCount / $totalChildren) * 100) : 0;

        $inSchoolCount = Child::whereHas('educationRecords', function($query) {
            $query->where('enrollment_status', 'enrolled')->latest();
        })->count();
        $inSchoolPercentage = $totalChildren > 0 ? round(($inSchoolCount / $totalChildren) * 100) : 0;

        $needAttentionCount = Child::whereHas('healthRecords', function($query) {
            $query->where('status', 'needs_attention')->latest();
        })->count();

        $stats = [
            'total_children' => $totalChildren,
            'good_health_percentage' => $goodHealthPercentage,
            'in_school_percentage' => $inSchoolPercentage,
            'need_attention_count' => $needAttentionCount,
        ];

        return view('children.index', compact('children', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('children.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'admission_date' => 'required|date',
            'status' => 'required|in:active,sponsored,adopted,discharged',
            'background' => 'nullable|string',
            'admission_notes' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('children/photos', 'public');
            $validated['photo'] = $path;
        }

        // Create the child
        $child = Child::create($validated);

        // Broadcast the event
        event(new \App\Events\ChildRegistered($child));

        return redirect()->route('children.index')->with('success', 'Child registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
