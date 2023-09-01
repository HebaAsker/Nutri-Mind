<?php

use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\PatientSavedMealController;
use App\Http\Controllers\API\PatientSelectedMealController;
use App\Http\Controllers\API\PatientSuggestedMealController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\SuggestedMealController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\Chat\ChatController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\Patient\QouteController;
use App\Http\Controllers\API\DoctorWorkTimeController;
use App\Http\Controllers\API\MealController;
use App\Http\Controllers\API\MoodController;
use App\Http\Controllers\API\Patient\PatientController;
use App\Http\Controllers\API\Patient\QuestionnaireController;

//--------------------------------Routes for patient app features--------------------------------//
Route::middleware('auth:patient')->group(function () {
    Route::get('/doctors', [PatientController::class, 'index'])->name('display_doctors');
    Route::get('/doctor/{id}', [PatientController::class, 'show'])->name('doctor_profile');
    Route::get('/doctors/search', [PatientController::class, 'search'])->name('find_doctor');
    Route::get('/qoutes', [QouteController::class, 'index'])->name('get_qoutes');
    Route::get('/questions',[QuestionnaireController::class,'show'])->name('display_questions');
    Route::post('/answer/questions',[QuestionnaireController::class,'answer']);
    Route::get('/calories',[PatientController::class,'calculate']);
    Route::get('/recommended-calories',[PatientController::class,'recommendedCalories']);
});
//------------------------------End Routes for patient app features------------------------------//




//--------------------------Routes for Chat between doctor and patient--------------------------//
Route::middleware('auth')->group(function () {
    Route::post('/create-chat', [ChatController::class, 'create']);
    Route::get('/show-chat-messages', [ChatController::class, 'showMessages']);
    Route::get('/show-chats', [ChatController::class, 'showChats']);
    Route::get('/chats/search', [ChatController::class, 'search']);
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


Route::resource('notes', NoteController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('doctor_work_times', DoctorWorkTimeController::class);
Route::resource('payment', PaymentController::class);
Route::resource('appointment', AppointmentController::class);
Route::resource('meals',MealController::class);
Route::resource('moods',MoodController::class);
Route::resource('patient_saved_meals',PatientSavedMealController::class);
Route::resource('patient_suggested_meals',PatientSuggestedMealController::class);
Route::resource('patient_selected_meals',PatientSelectedMealController::class);
Route::resource('suggested_meals',SuggestedMealController::class);
Route::resource('game',GameController::class);
Route::resource('reports',ReportController::class);
Route::get('patient_info/{appointment_id}',[AppointmentController::class,'patient_info']);
Route::get('serch_for_note',[NoteController::class,'search']);



