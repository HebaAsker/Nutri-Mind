<?php

use App\Events\SendMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Patient\PatientController;
use App\Http\Controllers\API\Chat\DoctorMessageController;
use App\Http\Controllers\API\Chat\PatientMessageController;
use App\Models\Doctor;
use App\Models\Patient;

//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/doctors',[PatientController::class,'index']);
    Route::get('/doctor/{id}',[PatientController::class,'show']);
});
//------------------------------End Routes for patient app features------------------------------//



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






