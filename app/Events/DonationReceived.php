<?php

namespace App\Events;

use App\Models\Donation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DonationReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
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
            'id' => $this->donation->id,
            'donor_name' => $this->donation->donor->full_name ?? 'Anonymous',
            'amount' => $this->donation->amount,
            'type' => $this->donation->donation_type,
            'message' => 'New donation received: $' . number_format($this->donation->amount, 2) . ' from ' . ($this->donation->donor->full_name ?? 'Anonymous'),
        ];
    }
}
