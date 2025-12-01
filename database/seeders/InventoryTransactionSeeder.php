<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\InventoryTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InventoryTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $items = InventoryItem::all();

        if (!$user || $items->isEmpty()) {
            return;
        }

        foreach ($items as $item) {
            $currentQuantity = 0;

            // Add some incoming transactions (restocks)
            $quantity = rand(50, 200);
            $quantityBefore = $currentQuantity;
            $currentQuantity += $quantity;

            InventoryTransaction::create([
                'inventory_item_id' => $item->id,
                'transaction_type' => 'in',
                'quantity' => $quantity,
                'quantity_before' => $quantityBefore,
                'quantity_after' => $currentQuantity,
                'unit_cost' => $item->unit_cost,
                'total_cost' => $quantity * $item->unit_cost,
                'transaction_date' => Carbon::now()->subDays(rand(25, 35)),
                'reference_number' => 'IN-' . strtoupper(uniqid()),
                'notes' => 'Initial stock replenishment',
                'performed_by' => $user->id,
            ]);

            // Add some outgoing transactions (usage)
            $outgoingCount = rand(3, 8);
            for ($i = 0; $i < $outgoingCount; $i++) {
                $quantity = rand(5, 30);
                $quantityBefore = $currentQuantity;
                $currentQuantity -= $quantity;

                InventoryTransaction::create([
                    'inventory_item_id' => $item->id,
                    'transaction_type' => 'out',
                    'quantity' => $quantity,
                    'quantity_before' => $quantityBefore,
                    'quantity_after' => $currentQuantity,
                    'unit_cost' => $item->unit_cost,
                    'total_cost' => $quantity * $item->unit_cost,
                    'transaction_date' => Carbon::now()->subDays(rand(1, 30)),
                    'reference_number' => 'OUT-' . strtoupper(uniqid()),
                    'notes' => 'Regular usage',
                    'performed_by' => $user->id,
                ]);
            }

            // Add another restock in the last few days
            $quantity = rand(30, 100);
            $quantityBefore = $currentQuantity;
            $currentQuantity += $quantity;

            InventoryTransaction::create([
                'inventory_item_id' => $item->id,
                'transaction_type' => 'in',
                'quantity' => $quantity,
                'quantity_before' => $quantityBefore,
                'quantity_after' => $currentQuantity,
                'unit_cost' => $item->unit_cost,
                'total_cost' => $quantity * $item->unit_cost,
                'transaction_date' => Carbon::now()->subDays(rand(1, 5)),
                'reference_number' => 'IN-' . strtoupper(uniqid()),
                'notes' => 'Recent restock',
                'performed_by' => $user->id,
            ]);
        }
    }
}
