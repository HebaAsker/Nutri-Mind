<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\DoctorWorkTime;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer|exists:doctors,id',
        ], [
            'doctor_id.*' => 'Unauthorized Access',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $appointments = Appointment::where('doctor_id', $request->doctor_id)->get();

        return $this->returnData('appointments', $appointments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();

        if ($validated->fails())
            dd($validated);

        Appointment::create($request->all());
        DoctorWorkTime::where('id', $request->doctor_id)->update([
            'status' => 'set'
        ]);

        return $this->returnSuccess('Appointemnt added successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return $this->returnData('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return $this->returnData('appointment', $appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $validated = $request->validated();

        if ($validated->fails()) {
            return $this->returnError($validated->errors());
        }

        // Update the appointment
        $appointment->update($request->all());
        DoctorWorkTime::where('id', $request->doctor_work_time_id)->update([
            'status' => 'set'
        ]);

        return $this->returnSuccess('Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $rules = [
            'doctor_work_time_id' => 'required|integer|exists:doctor_work_times,id',
        ];

        $messages = [
            'doctor_work_time_id.required' => 'You must choose time to set that appointmet',
            'doctor_work_time_id.integer' => 'Unauthorized Access',
            'doctor_work_time_id.exists' => 'That time is not valid'
        ];
        $validator = Validator::make($appointment->doctor_work_time_id, $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        // payment we need to give the patient his money again, will work in that after paypal
        DoctorWorkTime::where('id', $appointment->doctor_work_time_id)->update([
            'status' => 'not set'
        ]);
        $appointment->delete();
    }
}
