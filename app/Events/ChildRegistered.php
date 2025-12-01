<?php

namespace App\Events;

use App\Models\Child;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChildRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $child;

    public function __construct(Child $child)
    {
        $this->child = $child;
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
            'id' => $this->child->id,
            'name' => $this->child->first_name . ' ' . $this->child->last_name,
            'age' => $this->child->age ?? 'N/A',
            'admission_date' => $this->child->admission_date,
            'message' => 'New child registered: ' . $this->child->first_name . ' ' . $this->child->last_name,
        ];
    }
}
