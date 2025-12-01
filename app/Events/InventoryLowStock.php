<?php

namespace App\Events;

use App\Models\InventoryItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InventoryLowStock implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    public function __construct(InventoryItem $item)
    {
        $this->item = $item;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('dashboard'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->item->id,
            'name' => $this->item->name,
            'current_quantity' => $this->item->quantity,
            'minimum_quantity' => $this->item->minimum_quantity,
            'message' => 'Low stock alert: ' . $this->item->name . ' (Only ' . $this->item->quantity . ' left)',
        ];
    }
}
