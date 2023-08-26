<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DoctorWorkTime;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorWorkTimeController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
{
    $rules = [
        'date' => 'required|date',
        'doctor_id' => 'required|integer|exists:doctors,id',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return $this->returnError($validator->errors());
    }

    $doctorWorkTimes = DoctorWorkTime::where('date', $request->date)
        ->where('doctor_id', $request->doctor_id)
        ->get();

    return $this->returnData('doctorWorkTimes', $doctorWorkTimes);
}

    public function create()
    {
        return view('DoctorWorkTimes.index');
    }
    public function store(Request $request)
    {
        // return $request;
        if(isset($request->available_times) && !empty($request->available_times))
        $request->available_times = array_unique($request->available_times);
        $rules = [
            'date' => 'required|date',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'available_times' => 'array',
            'available_times.*' => 'string|regex:/^[0-2][0-9]:[0-5][0-9]$/|unique:doctor_work_times,date,time'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $doctorWorkTimes = DoctorWorkTime::whereDate('date', $request->date)
            ->whereDoctorId($request->doctor_id)
            ->get();
        if ($doctorWorkTimes) {
            foreach ($doctorWorkTimes as $doctorWorkTime)
                $doctorWorkTime->delete();
        }foreach ($request->available_times as $available_time) {
            DoctorWorkTime::create(
                [
                'date' => $request->date,
                'time' => $available_time,
                'status' => 'not set',
                'doctor_id' => $request->doctor_id
            ]);
        }
        return $this->returnSuccess('Your work Time is set successfully.');
    }

}
