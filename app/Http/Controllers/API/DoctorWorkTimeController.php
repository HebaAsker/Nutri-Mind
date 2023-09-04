<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorWorkTimeRequest;
use App\Models\DoctorWorkTime;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DoctorWorkTimeController extends Controller
{
    use GeneralTrait;

    // in the above of book an appointment
    public function index(Request $request)
    {
        return $this->getData($request, 'App\Models\DoctorWorkTime', false);
    }

    // day array, time: string from 9:00 am to 2:00 pm , doctor_id,
    public function store(DoctorWorkTimeRequest $request)
    {
        $validated = $request->validated();

        $time = $request->input('time');
        [$startTime, $finishTime] = explode(' to ', $time);

        // Convert start time to 24-hour format
        $startTime = Carbon::parse($startTime)->format('H:i');

        // Convert finish time to 24-hour format
        $finishTime = Carbon::parse($finishTime)->format('H:i');

        $doctorId = $request->input('doctor_id');

        foreach ($request->input('day') as $day) {
            $doctorWorkTime = new DoctorWorkTime();
            $doctorWorkTime->day_name = $day;
            $doctorWorkTime->start_time = $startTime;
            $doctorWorkTime->finish_time = $finishTime;
            $doctorWorkTime->doctor_id = $doctorId;
            $doctorWorkTime->save();
        }

        return $this->returnSuccess('Time set successfully.');
    }
}
