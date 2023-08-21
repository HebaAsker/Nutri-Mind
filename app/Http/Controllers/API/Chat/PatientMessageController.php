<?php

namespace App\Http\Controllers\API\Chat;


use App\Models\Chat;
use App\Models\Patient;
use App\Lib\PusherFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;

class PatientMessageController extends Controller
{
    public function index()
    {
        //return all patient chats
        $chats = Chat::where('patient_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return response([
            'message' => $chats
        ]);
    }


    public function show(Request $request){
        //return all messages in specific doctor chat
        $chats = Chat::where('patient_id', Auth::id())->where('doctor_id', $request->doctor_id)->orderBy('created_at', 'DESC')->get();
        return response([
            'message' => $chats
        ]);
    }

}
