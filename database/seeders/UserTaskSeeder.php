<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserTask;
use App\Models\User;
use App\Models\Child;
use Carbon\Carbon;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a non-admin user (or create one if needed)
        $user = User::where('role', 'user')->first();

        if (!$user) {
            echo "No user with role 'user' found. Please create a regular user first.\n";
            return;
        }

        // Get some children for task assignment
        $children = Child::limit(5)->get();

        if ($children->isEmpty()) {
            echo "No children found. Creating tasks without child assignment.\n";
        }

        // Create sample tasks
        $tasks = [
            [
                'user_id' => $user->id,
                'child_id' => $children->first()->id ?? null,
                'task_type' => 'health_checkup',
                'title' => 'Schedule Annual Health Checkup',
                'description' => 'Arrange annual health checkup with Dr. Smith at City Hospital',
                'due_date' => Carbon::now()->addDays(5),
                'priority' => 'high',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 1 ? $children->get(1)->id : null,
                'task_type' => 'education_assessment',
                'title' => 'Complete Education Progress Report',
                'description' => 'Review and update quarterly education assessment',
                'due_date' => Carbon::now()->addDays(3),
                'priority' => 'medium',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 2 ? $children->get(2)->id : null,
                'task_type' => 'medical_appointment',
                'title' => 'Dental Appointment Follow-up',
                'description' => 'Schedule follow-up dental appointment for cavity treatment',
                'due_date' => Carbon::now()->addDays(7),
                'priority' => 'medium',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 3 ? $children->get(3)->id : null,
                'task_type' => 'update_profile',
                'title' => 'Update Child Profile Information',
                'description' => 'Update contact information and emergency contacts',
                'due_date' => Carbon::now()->subDays(2),
                'priority' => 'urgent',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 4 ? $children->get(4)->id : null,
                'task_type' => 'health_checkup',
                'title' => 'Vision Screening Required',
                'description' => 'Annual vision screening is due for school requirements',
                'due_date' => Carbon::now()->subDays(5),
                'priority' => 'high',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->first()->id ?? null,
                'task_type' => 'general',
                'title' => 'Organize School Supplies',
                'description' => 'Purchase and organize school supplies for new semester',
                'due_date' => Carbon::now()->addDays(10),
                'priority' => 'low',
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 1 ? $children->get(1)->id : null,
                'task_type' => 'health_checkup',
                'title' => 'Vaccination Record Update',
                'description' => 'Update vaccination records and schedule any missing vaccines',
                'due_date' => Carbon::now()->addDays(14),
                'priority' => 'medium',
                'status' => 'pending',
            ],
            // Completed tasks for demonstration
            [
                'user_id' => $user->id,
                'child_id' => $children->first()->id ?? null,
                'task_type' => 'general',
                'title' => 'Submit Monthly Report',
                'description' => 'Submitted monthly care report to administration',
                'due_date' => Carbon::now()->subDays(10),
                'priority' => 'high',
                'status' => 'completed',
                'completed_at' => Carbon::now()->subDays(9),
            ],
            [
                'user_id' => $user->id,
                'child_id' => $children->count() > 1 ? $children->get(1)->id : null,
                'task_type' => 'update_profile',
                'title' => 'Update Medical History',
                'description' => 'Updated medical history with recent visit notes',
                'due_date' => Carbon::now()->subDays(15),
                'priority' => 'medium',
                'status' => 'completed',
                'completed_at' => Carbon::now()->subDays(14),
            ],
        ];

        foreach ($tasks as $task) {
            UserTask::create($task);
        }

        echo "Successfully created " . count($tasks) . " test tasks for user: {$user->name}\n";
    }
}
