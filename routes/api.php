<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Patient\PatientController;



//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/doctors',[PatientController::class,'index']);
    Route::get('/doctor
    /{id}',[PatientController::class,'show']);
});
//------------------------------End Routes for patient app features------------------------------//







