<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorWorkTimeRequest;
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
    $messages=[
        'date.required'=> 'You must choose date.',
        'date.date'=>"The date must be a valid date.",
        'doctor_id.required' => 'Please select doctor.',
        'doctor_id.integer' => 'You are not authorized to access this information..',
        'doctor_id.exists' => 'The selected doctor does not exist.',
        ];

    $validator = Validator::make($request->only(['date','doctor_id']), $rules,$messages);

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
    public function store(DoctorWorkTimeRequest $request)
    {
        // return $request;
        if(isset($request->available_times) && !empty($request->available_times))
        $request->available_times = array_unique($request->available_times);

        $validated=$request->validated();

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
        return $this->returnSuccess('Your working Times is set successfully.');
    }

}
