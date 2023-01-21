<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use function Ramsey\Uuid\v1;

class MpesaPaymentCaptured implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $status;
    public $message;
    public $distributor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $status, $message, $distributor = false)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->message = $message;
        $this->distributor = $distributor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channel = $this->distributor ? 'distributor_payments.'.$this->userId : 'payments.'.$this->userId;
        return new PrivateChannel('payments.'.$this->userId);
    }
}
