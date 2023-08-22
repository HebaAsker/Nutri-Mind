<?php

use App\Events\SendMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\Patient\PatientController;
use App\Http\Controllers\API\Chat\DoctorMessageController;
use App\Http\Controllers\API\Chat\PatientMessageController;


//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/doctors',[PatientController::class,'index']);
    Route::get('/doctor/{id}',[PatientController::class,'show']);
});
//------------------------------End Routes for patient app features------------------------------//


Route::post('/create-chat',[ChatController::class,'create'])->middleware('auth');
Route::get('/show-chat-messages',[ChatController::class,'showMessages'])->middleware('auth');
Route::get('/show-chats',[ChatController::class,'showChats'])->middleware('auth');

//--------------------------Routes for Chat between doctor and patient--------------------------//



//--------------------------End Routes for Chat between doctor and patient--------------------------//






