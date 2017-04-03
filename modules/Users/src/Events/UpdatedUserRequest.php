<?php

namespace Modules\Users\Src\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Modules\Users\Src\Models\User;

class UpdatedUserRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $user;
    public $params;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, array $params)
    {
        $this->user = $user;
        $this->params = $params;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getParams()
    {
        return $this->params;
    }
}
