<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorSetTimeIndexRequest;
use App\Models\DoctorSetTime;
use App\Models\DoctorWorkTime;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DoctorSetTimeController extends Controller
{
    use GeneralTrait;
    public function index(DoctorSetTimeIndexRequest $request)
    {
        $validated = $request->validated();
        $date = $request->date;
        $dayName = date('l', strtotime($date));
        $times = DoctorSetTime::where('doctor_id', $request->doctor_id)->where('date', $date)->get();

        if ($times->isEmpty()) {
            $doctorWorkTime = DoctorWorkTime::where('doctor_id', $request->doctor_id)->where('day_name', $dayName)->first();

            if ($doctorWorkTime) {
                $startTime = Carbon::parse($doctorWorkTime->start_time);
                $finishTime = Carbon::parse($doctorWorkTime->finish_time);
                $current = $startTime->copy();

                while ($current <= $finishTime) {
                    DoctorSetTime::create([
                        'date' => $date,
                        'time' => $current->format('H:i'),
                        'doctor_id' => $request->doctor_id
                    ]);
                    $current->addMinutes(30);
                }

                $times = DoctorSetTime::where('doctor_id', $request->doctor_id)->where('date', $date)->where('status', 'not set')->get();
            }
        } else {
            $times = $times->where('status', 'not set');
        }

        return $this->returnData('available times', $times);
    }
}
