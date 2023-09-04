<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoChat
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video;


    public function __construct($video)
    {
        $this->video = $video;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('video-call-channel.' .  $this->video->patient_id),
            new PrivateChannel('video-call-channel.' .  $this->video->doctor_id),
        ];
    }
}
