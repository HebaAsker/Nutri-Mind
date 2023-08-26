<?php

use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\DoctorWorkTimeController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('notes',NoteController::class);
Route::resource('reviews',ReviewController::class);
Route::resource('doctor_work_times',DoctorWorkTimeController::class);
Route::resource('payment',PaymentController::class);
Route::resource('appointment',AppointmentController::class);

require __DIR__.'/auth.php';
