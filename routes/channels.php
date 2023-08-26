<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

<<<<<<< HEAD
Broadcast::channel('App.Models.Doctor.{id}', function ($doctor, $id) {
    return (int) $doctor->id === (int) $id;
});

Broadcast::channel('App.Models.Patient.{id}', function ($patient, $id) {
    return (int) $patient->id === (int) $id;
});

Broadcast::channel('chat-message.{doctor_id}', function ($doctor, $doctor_id) {
    return (int) $doctor->id === (int) $doctor_id;
});

Broadcast::channel('chat-message.{patient_id}', function ($patient, $patient_id) {
    return (int) $patient->id === (int) $patient_id;
=======
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
>>>>>>> 500c997b32e9126b6193db74114324d168009175
});
