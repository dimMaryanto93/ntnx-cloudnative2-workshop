<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    use SerializesModels;

    public function __construct($data)
    {
        //$data = $data[0];

        //dd($data);
        
        $this->title = $data['title'];
        $this->name = $data['name']; 
        $this->last_name = $data['last_name'];
        $this->address = $data['address'];
        $this->zip_code = $data['zip_code'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->email = $data['email'];
        
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
}
