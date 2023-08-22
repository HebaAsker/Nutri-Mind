<?php

namespace App\Events;

<<<<<<< HEAD

=======
use App\Models\Message;
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

<<<<<<< HEAD
class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
=======
class SendMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22

    /**
     * Create a new event instance.
     *
     * @return void
     */
<<<<<<< HEAD
    public function __construct($chat)
    {
        $this->chat = $chat;
=======
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastAs()
    {
        return 'sendMessage';
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
<<<<<<< HEAD
        return new PrivateChannel('chat-message.' . $this->chat->patient_id);
=======
        return new PrivateChannel('chat-message.' . $this->message->patient_id);
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
    }
}
