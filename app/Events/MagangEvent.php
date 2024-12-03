<?php

namespace App\Events;

use App\Models\Magang;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MagangEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Magang $magang;
    // protected string $level;


    public function getMagang()
    {
        return $this->magang;
    }


    /**
     * Create a new event instance.
     */
    public function __construct(Magang $magang)
    {
        $this->magang = $magang;
        // $this->level = $level;
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
