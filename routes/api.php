<?php
<<<<<<< HEAD


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\Patient\PatientController;


//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/doctors',[PatientController::class,'index']);
    Route::get('/doctor/{id}',[PatientController::class,'show']);
});
//------------------------------End Routes for patient app features------------------------------//




//--------------------------Routes for Chat between doctor and patient--------------------------//
Route::middleware('auth')->group(function(){
    Route::post('/create-chat',[ChatController::class,'create']);
    Route::get('/show-chat-messages',[ChatController::class,'showMessages']);
    Route::get('/show-chats',[ChatController::class,'showChats']);
});


//--------------------------End Routes for Chat between doctor and patient--------------------------//








=======
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\DoctorWorkTimeController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function () {
    Route::resource('notes', NoteController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('doctor_work_times', DoctorWorkTimeController::class);
    Route::resource('payment',PaymentController::class);
    Route::resource('appointment',AppointmentController::class);
});
>>>>>>> 500c997b32e9126b6193db74114324d168009175
