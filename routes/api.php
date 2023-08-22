<?php

use App\Events\SendMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\Patient\PatientController;
use App\Http\Controllers\API\Chat\DoctorMessageController;
use App\Http\Controllers\API\Chat\PatientMessageController;
<<<<<<< HEAD

=======
use App\Models\Doctor;
use App\Models\Patient;
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22

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


//--------------------------Routes for Chat between doctor and patient--------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/patient/chats',[PatientMessageController::class,'index']);
    Route::get('/patient/chats/{doctor_id}',[PatientMessageController::class,'show']);
     });


Route::middleware('auth:doctor')->group(function(){
    Route::get('/doctor/chats',[DoctorMessageController::class,'index']);
    Route::get('/doctor/chats/{patient_id}',[DoctorMessageController::class,'show']);
});


//--------------------------End Routes for Chat between doctor and patient--------------------------//






