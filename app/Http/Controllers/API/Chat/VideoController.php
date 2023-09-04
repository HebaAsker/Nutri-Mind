<?php

namespace App\Http\Controllers\API\Chat;

use App\Events\VideoChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function callUser(Request $request)
    {
        $sender_name = Auth::id();
        $receiver_name = $request->receiver_name;
        $type = 'incomingCall';

        // Prepare data for the event
        $video = [
            'sender_name' => $sender_name,
            'receiver_name' => $receiver_name,
            'type' => $type,
        ];

        broadcast(new VideoChat($video))->toOthers();
    }


    public function acceptCall(Request $request)
    {
        $receiver_name = $request->receiver_name;
        $type = 'incomingCall';

        // Prepare data for the event
        $video = [
            'receiver_name' => $receiver_name,
            'type' => $type,
        ];
        broadcast(new VideoChat($video))->toOthers();
    }
}
