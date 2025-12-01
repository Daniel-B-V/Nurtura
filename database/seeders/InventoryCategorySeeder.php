<?php

namespace Database\Seeders;

use App\Models\InventoryCategory;
use Illuminate\Database\Seeder;

class InventoryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Food and nutritional items',
                'icon' => 'utensils',
                'color' => '#10B981',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Medical',
                'slug' => 'medical',
                'description' => 'Medical supplies and medications',
                'icon' => 'pills',
                'color' => '#EF4444',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Clothing and footwear',
                'icon' => 'shirt',
                'color' => '#3B82F6',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Hygiene',
                'slug' => 'hygiene',
                'description' => 'Hygiene and sanitation products',
                'icon' => 'soap',
                'color' => '#8B5CF6',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'School Supplies',
                'slug' => 'school-supplies',
                'description' => 'Educational materials and school supplies',
                'icon' => 'book',
                'color' => '#F59E0B',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Other',
                'slug' => 'other',
                'description' => 'Miscellaneous items',
                'icon' => 'box',
                'color' => '#6B7280',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            InventoryCategory::create($category);
        }
    }
}
