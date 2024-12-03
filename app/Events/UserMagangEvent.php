<?php

namespace App\Events;

use App\Models\UserMagang;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserMagangEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $userMagang;

    public function getUserMagang()
    {
        return $this->userMagang;
    }
    /**
     * Create a new event instance.
     */
    public function __construct(UserMagang $userMagang)
    {
        $this->userMagang = $userMagang;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
