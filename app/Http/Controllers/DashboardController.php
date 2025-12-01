<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\Volunteer;
use App\Models\InventoryItem;
use App\Models\ChildWelfareNote;
use App\Models\ChildNeed;
use App\Models\ChildHealthRecord;
use App\Models\AIRecommendation;
use App\Models\Sponsorship;
use App\Models\UserTask;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is admin or regular user
        if (auth()->user()->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        // Overall Statistics
        $stats = [
            'total_children' => Child::count(),
            'active_children' => Child::active()->count(),
            'sponsored_children' => Child::sponsored()->count(),
            'total_donors' => Donor::active()->count(),
            'total_donations_this_month' => Donation::whereMonth('donation_date', now()->month)
                                                    ->whereYear('donation_date', now()->year)
                                                    ->sum('amount') ?? 0,
            'total_donations_count' => Donation::whereMonth('donation_date', now()->month)->count(),
            'active_volunteers' => Volunteer::active()->count(),
            'low_stock_items' => InventoryItem::lowStock()->count(),
            'out_of_stock_items' => InventoryItem::outOfStock()->count(),
            'critical_welfare_notes' => ChildWelfareNote::critical()->count(),
            'pending_needs' => ChildNeed::pending()->count(),
            'critical_needs' => ChildNeed::critical()->count(),
            'active_sponsorships' => Sponsorship::active()->count(),
        ];

        // AI Recommendations
        $aiRecommendations = AIRecommendation::pending()
                                             ->highPriority()
                                             ->latest()
                                             ->take(5)
                                             ->get();

        // Inventory Alerts
        $lowStockAlerts = InventoryItem::lowStock()
                                      ->with('category')
                                      ->orderBy('quantity', 'asc')
                                      ->take(10)
                                      ->get();

        // Upcoming Health Appointments
        $upcomingAppointments = ChildHealthRecord::upcomingAppointments()
                                                 ->with('child')
                                                 ->take(10)
                                                 ->get();

        // Recent Children
        $recentChildren = Child::recentlyAdmitted(30)
                              ->latest('admission_date')
                              ->take(5)
                              ->get();

        // Critical Welfare Notes
        $criticalWelfareNotes = ChildWelfareNote::critical()
                                               ->with('child', 'recordedBy')
                                               ->latest()
                                               ->take(5)
                                               ->get();

        // Recent Donations
        $recentDonations = Donation::with('donor', 'child')
                                  ->latest('donation_date')
                                  ->take(10)
                                  ->get();

        // Monthly Donation Trend (last 6 months)
        $donationTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $donationTrend[] = [
                'month' => $month->format('M Y'),
                'amount' => Donation::whereMonth('donation_date', $month->month)
                                   ->whereYear('donation_date', $month->year)
                                   ->sum('amount') ?? 0,
            ];
        }

        return view('dashboard', compact(
            'stats',
            'aiRecommendations',
            'lowStockAlerts',
            'upcomingAppointments',
            'recentChildren',
            'criticalWelfareNotes',
            'recentDonations',
            'donationTrend'
        ));
    }

    private function userDashboard()
    {
        $userId = auth()->id();

        // User-specific statistics
        $stats = [
            'total_children' => Child::count(),
            'active_children' => Child::active()->count(),
            'my_pending_tasks' => UserTask::forUser($userId)->pending()->count(),
            'my_overdue_tasks' => UserTask::forUser($userId)->overdue()->count(),
            'completed_today' => UserTask::forUser($userId)
                                        ->completed()
                                        ->whereDate('completed_at', today())
                                        ->count(),
            'total_activities_week' => ActivityLog::forUser($userId)->recent(7)->count(),
        ];

        // My Tasks
        $myTasks = UserTask::forUser($userId)
                          ->pending()
                          ->with('child')
                          ->orderBy('due_date', 'asc')
                          ->take(10)
                          ->get();

        // Overdue Tasks
        $overdueTasks = UserTask::forUser($userId)
                               ->overdue()
                               ->with('child')
                               ->get();

        // Recent Activities
        $recentActivities = ActivityLog::forUser($userId)
                                      ->latest()
                                      ->take(10)
                                      ->get();

        // Recent Children (for reference)
        $recentChildren = Child::latest('admission_date')
                              ->take(5)
                              ->get();

        return view('dashboard-user', compact(
            'stats',
            'myTasks',
            'overdueTasks',
            'recentActivities',
            'recentChildren'
        ));
    }
}
