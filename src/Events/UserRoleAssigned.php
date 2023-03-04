<?php

namespace Vxize\Lavx\Events;

use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRoleAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $assigner, $assignee, $roles, $ip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $assigner, User $assignee, $roles, $ip)
    {
        $this->assigner = $assigner;
        $this->assignee = $assignee;
        $this->roles = $roles;
        $this->ip = $ip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
