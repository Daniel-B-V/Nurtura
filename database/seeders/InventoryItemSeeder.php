<?php

namespace Database\Seeders;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    public function run(): void
    {
        $food = InventoryCategory::where('slug', 'food')->first();
        $medical = InventoryCategory::where('slug', 'medical')->first();
        $clothing = InventoryCategory::where('slug', 'clothing')->first();
        $hygiene = InventoryCategory::where('slug', 'hygiene')->first();
        $school = InventoryCategory::where('slug', 'school-supplies')->first();

        $items = [
            // Medical Supplies - Critical
            [
                'category_id' => $medical?->id,
                'name' => 'Medical Supplies Kit',
                'sku' => 'MED-001',
                'description' => 'Essential medical supplies including bandages, gauze, and antiseptics',
                'unit' => 'units',
                'quantity' => 45,
                'minimum_quantity' => 100,
                'maximum_quantity' => 350,
                'unit_cost' => 25.00,
                'total_value' => 1125.00,
                'location' => 'Medical Storage Room',
                'status' => 'available',
            ],

            // Food - Low Stock
            [
                'category_id' => $food?->id,
                'name' => 'Rice & Grains',
                'sku' => 'FOOD-001',
                'description' => 'Mixed rice and grains for daily meals',
                'unit' => 'kg',
                'quantity' => 780,
                'minimum_quantity' => 1000,
                'maximum_quantity' => 2000,
                'unit_cost' => 2.50,
                'total_value' => 1950.00,
                'location' => 'Main Food Storage',
                'status' => 'available',
            ],

            // Clothing - Good Stock
            [
                'category_id' => $clothing?->id,
                'name' => 'Winter Clothing',
                'sku' => 'CLO-001',
                'description' => 'Winter jackets, sweaters, and warm clothing',
                'unit' => 'pieces',
                'quantity' => 156,
                'minimum_quantity' => 80,
                'maximum_quantity' => 200,
                'unit_cost' => 15.00,
                'total_value' => 2340.00,
                'location' => 'Clothing Storage',
                'status' => 'available',
            ],

            // Hygiene - Low Stock
            [
                'category_id' => $hygiene?->id,
                'name' => 'Hygiene Products',
                'sku' => 'HYG-001',
                'description' => 'Soap, shampoo, toothpaste, and other hygiene essentials',
                'unit' => 'units',
                'quantity' => 92,
                'minimum_quantity' => 150,
                'maximum_quantity' => 300,
                'unit_cost' => 5.00,
                'total_value' => 460.00,
                'location' => 'Hygiene Storage',
                'status' => 'available',
            ],

            // School Supplies - Excellent Stock
            [
                'category_id' => $school?->id,
                'name' => 'School Notebooks',
                'sku' => 'SCH-001',
                'description' => 'Notebooks, exercise books, and writing pads',
                'unit' => 'units',
                'quantity' => 245,
                'minimum_quantity' => 100,
                'maximum_quantity' => 280,
                'unit_cost' => 1.50,
                'total_value' => 367.50,
                'location' => 'Education Storage',
                'status' => 'available',
            ],

            // Food - Low Stock
            [
                'category_id' => $food?->id,
                'name' => 'Fresh Vegetables',
                'sku' => 'FOOD-002',
                'description' => 'Fresh seasonal vegetables',
                'unit' => 'kg',
                'quantity' => 124,
                'minimum_quantity' => 200,
                'maximum_quantity' => 350,
                'unit_cost' => 3.00,
                'total_value' => 372.00,
                'location' => 'Cold Storage',
                'status' => 'available',
            ],

            // Additional items for variety
            [
                'category_id' => $food?->id,
                'name' => 'Cooking Oil',
                'sku' => 'FOOD-003',
                'description' => 'Vegetable cooking oil',
                'unit' => 'liters',
                'quantity' => 85,
                'minimum_quantity' => 100,
                'maximum_quantity' => 200,
                'unit_cost' => 4.50,
                'total_value' => 382.50,
                'location' => 'Main Food Storage',
                'status' => 'available',
            ],

            [
                'category_id' => $medical?->id,
                'name' => 'First Aid Kits',
                'sku' => 'MED-002',
                'description' => 'Portable first aid kits',
                'unit' => 'units',
                'quantity' => 28,
                'minimum_quantity' => 50,
                'maximum_quantity' => 100,
                'unit_cost' => 35.00,
                'total_value' => 980.00,
                'location' => 'Medical Storage Room',
                'status' => 'available',
            ],

            [
                'category_id' => $clothing?->id,
                'name' => 'School Uniforms',
                'sku' => 'CLO-002',
                'description' => 'Standard school uniforms',
                'unit' => 'pieces',
                'quantity' => 180,
                'minimum_quantity' => 100,
                'maximum_quantity' => 250,
                'unit_cost' => 12.00,
                'total_value' => 2160.00,
                'location' => 'Clothing Storage',
                'status' => 'available',
            ],

            [
                'category_id' => $hygiene?->id,
                'name' => 'Towels & Bedding',
                'sku' => 'HYG-002',
                'description' => 'Bath towels and bed linens',
                'unit' => 'pieces',
                'quantity' => 145,
                'minimum_quantity' => 120,
                'maximum_quantity' => 200,
                'unit_cost' => 8.00,
                'total_value' => 1160.00,
                'location' => 'Hygiene Storage',
                'status' => 'available',
            ],

            [
                'category_id' => $school?->id,
                'name' => 'Pens & Pencils',
                'sku' => 'SCH-002',
                'description' => 'Writing instruments',
                'unit' => 'boxes',
                'quantity' => 68,
                'minimum_quantity' => 50,
                'maximum_quantity' => 100,
                'unit_cost' => 10.00,
                'total_value' => 680.00,
                'location' => 'Education Storage',
                'status' => 'available',
            ],

            [
                'category_id' => $food?->id,
                'name' => 'Canned Goods',
                'sku' => 'FOOD-004',
                'description' => 'Assorted canned food items',
                'unit' => 'units',
                'quantity' => 320,
                'minimum_quantity' => 200,
                'maximum_quantity' => 500,
                'unit_cost' => 2.00,
                'total_value' => 640.00,
                'location' => 'Main Food Storage',
                'status' => 'available',
            ],
        ];

        foreach ($items as $item) {
            InventoryItem::create($item);
        }
    }
}
