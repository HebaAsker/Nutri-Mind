<?php

namespace App\Http\Controllers\API\Chat;

use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Patient;
use App\Lib\PusherFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;

class DoctorMessageController extends Controller
{
    //return all doctor chats
    public function index()
    {
        $chats = Chat::where('doctor_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return response([
            'message' => $chats
        ]);
    }


    //return all messages in specific patient chat
    public function show(Request $request){
        $chats = Chat::where('doctor_id', Auth::id())->where('patient_id', $request->patient_id)->orderBy('created_at', 'DESC')->get();
        return response([
            'message' => $chats
        ]);
    }

    
}
