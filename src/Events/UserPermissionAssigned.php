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

class UserPermissionAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $assigner, $assignee, $permissions, $ip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $assigner, User $assignee, $permissions, $ip)
    {
        $this->assigner = $assigner;
        $this->assignee = $assignee;
        $this->permissions = $permissions;
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
