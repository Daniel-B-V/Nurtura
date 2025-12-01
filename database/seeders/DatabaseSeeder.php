<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InventoryCategorySeeder::class,
            InventoryItemSeeder::class,
            InventoryTransactionSeeder::class,
            DonorSeeder::class,
            DonationSeeder::class,
            // Add more seeders as needed:
            // ChildSeeder::class,
        ]);
    }
}
