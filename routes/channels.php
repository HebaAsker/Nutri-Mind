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

Broadcast::channel('chat-message.{doctor_id}', function ($doctor, $doctor_id) {
    return (int) $doctor->id === (int) $doctor_id;
});


Broadcast::channel('chat-message.{patient_id}', function ($patient, $patient_id) {
    return (int) $patient->id === (int) $patient_id;
});

Broadcast::channel('video-call-channel.{patient_id}', function ($patient, $patient_id) {
    return (int) $patient->id === (int) $patient_id;
});

Broadcast::channel('video-call-channel.{doctor_id}', function ($doctor, $doctor_id) {
    return (int) $doctor->id === (int) $doctor_id;
});

