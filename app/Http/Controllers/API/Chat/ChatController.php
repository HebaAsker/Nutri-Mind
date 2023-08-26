<?php

namespace App\Http\Controllers\API\Chat;

use Exception;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;
use Illuminate\Validation\Rules\Exists;
use App\Interfaces\Chats\ChatRepositoryInterface;

class ChatController extends Controller
{

    private $chatRepository;

    public function __construct(ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    //start new chat method
    public function create(MessageRequest $request)
    {
        return $this->chatRepository->create($request);
    }



    //show all messages in the chat
    public function showMessages(Request $request){
        $chat_messages = Message::all()->where('receiver_name',$request->receiver_name);
        return $chat_messages;
    }


    //show all chats user have
    public function showChats(){
        $chat = Chat::all()->where('sender_name',Auth::user()->name);
        return $chat;
    }
}
