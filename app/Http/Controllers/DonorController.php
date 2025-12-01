<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Models\Child;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch donors with their donations
        $donors = Donor::with(['donations' => function($query) {
            $query->latest();
        }])->where('status', 'active')->get();

        // Fetch volunteers
        $volunteers = Volunteer::where('status', 'active')->get();

        // Calculate stats
        $totalDonors = Donor::where('status', 'active')->count();
        $activeVolunteers = Volunteer::where('status', 'active')->count();
        $thisMonthDonations = Donation::whereMonth('donation_date', now()->month)
                                      ->whereYear('donation_date', now()->year)
                                      ->sum('amount');
        $volunteerHours = Volunteer::where('status', 'active')->sum('total_hours') ?? 1248;

        // AI Matching suggestions (mock data for now)
        $aiMatches = [
            [
                'donor_name' => 'Sarah Johnson',
                'child_name' => 'Emma Thompson',
                'match_percentage' => 95,
                'shared_interest' => 'Shared interest in arts and education',
                'recommendation' => 'Highly recommended for sponsorship',
            ],
            [
                'donor_name' => 'Michael Chen',
                'child_name' => 'Daniel Martinez',
                'match_percentage' => 92,
                'shared_interest' => 'Both interested in technology and sports',
                'recommendation' => 'Strong match for mentorship program',
            ],
            [
                'donor_name' => 'Community Church',
                'child_name' => 'Sophia Chen',
                'match_percentage' => 88,
                'shared_interest' => 'Community involvement and family values',
                'recommendation' => 'Good fit for group sponsorship',
            ],
        ];

        $stats = [
            'total_donors' => $totalDonors,
            'active_volunteers' => $activeVolunteers,
            'this_month_donations' => $thisMonthDonations,
            'volunteer_hours' => $volunteerHours,
        ];

        return view('donors.index', compact('donors', 'volunteers', 'stats', 'aiMatches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
