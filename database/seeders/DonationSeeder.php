<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $donors = Donor::all();
        $user = User::first();

        if ($donors->isEmpty() || !$user) {
            return;
        }

        // Create donations for the past 6 months
        for ($month = 6; $month >= 0; $month--) {
            $donationsInMonth = rand(15, 30);

            for ($i = 0; $i < $donationsInMonth; $i++) {
                $donor = $donors->random();
                $date = Carbon::now()->subMonths($month)->subDays(rand(0, 28));

                Donation::create([
                    'donor_id' => $donor->id,
                    'donation_type' => rand(1, 10) > 7 ? 'in_kind' : 'monetary',
                    'amount' => rand(50, 5000),
                    'currency' => 'USD',
                    'description' => 'General donation for orphanage support',
                    'donation_date' => $date,
                    'payment_method' => collect(['bank_transfer', 'cash', 'check', 'online'])->random(),
                    'reference_number' => 'DON-' . strtoupper(uniqid()),
                    'is_anonymous' => rand(1, 10) > 8,
                    'is_recurring' => rand(1, 10) > 7,
                    'frequency' => rand(1, 10) > 7 ? 'monthly' : null,
                    'purpose' => collect(['general', 'education', 'healthcare', 'food', 'infrastructure'])->random(),
                    'recorded_by' => $user->id,
                ]);
            }
        }
    }
}
