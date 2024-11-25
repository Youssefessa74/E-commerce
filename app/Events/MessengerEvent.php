<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessengerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

       public $chat ;

    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('message.'.$this->chat->receiver_id),
        ];
    }

 public function broadcastWith(){
        return [
            'message' => $this->chat->message,
            'receiver_id' => $this->chat->receiver_id,
            'sender_id' => $this->chat->sender_id,
            'image' => $this->chat->sender->image,
            'date' => $this->chat->created_at,
        ];
    }
}
