<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\Patient\PatientController;


//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function(){
    Route::get('/doctors',[PatientController::class,'index'])->name('desplay_doctors');
    Route::get('/doctor/{id}',[PatientController::class,'show'])->name('doctor_profile');
    Route::get('/doctors/search',[PatientController::class,'search'])->name('find_doctor');
});
//------------------------------End Routes for patient app features------------------------------//




//--------------------------Routes for Chat between doctor and patient--------------------------//
Route::middleware('auth')->group(function(){
    Route::post('/create-chat',[ChatController::class,'create']);
    Route::get('/show-chat-messages',[ChatController::class,'showMessages']);
    Route::get('/show-chats',[ChatController::class,'showChats']);
});


//--------------------------End Routes for Chat between doctor and patient--------------------------//





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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function () {
    Route::resource('notes', NoteController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('doctor_work_times', DoctorWorkTimeController::class);
    Route::resource('payment',PaymentController::class);
    Route::resource('appointment',AppointmentController::class);
});
