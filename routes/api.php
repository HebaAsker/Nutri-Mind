<?php
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
