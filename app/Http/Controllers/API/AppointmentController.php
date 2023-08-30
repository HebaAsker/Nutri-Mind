<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\DoctorWorkTime;
use App\Models\Patient;
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

        Appointment::create($request->except(['age']));
        DoctorWorkTime::where('id', $request->doctor_id)->update([
            'status' => 'set'
        ]);
        $patinet = Patient::where('id', $request->patient_id);
        $patinet->update([
            'age' => $request->age
        ]);

        return $this->returnSuccess('Appointemnt added successfully.');
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

        DoctorWorkTime::where('id', $appointment->doctor_work_time_id)->update([
            'status' => 'not set'
        ]);

        $appointment->update($request->except(['age']));

        $patinet = Patient::where('id', $request->patient_id);
        $patinet->update([
            'age' => $request->age
        ]);

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
            'doctor_work_time_id.*' => 'Unauthorized Access.',
        ];
        $validator = Validator::make(['doctor_work_time_id' => $appointment->doctor_work_time_id], $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        // Restore payment to the patient if necessary (implementation pending)

        DoctorWorkTime::where('id', $appointment->doctor_work_time_id)->update([
            'status' => 'not set'
        ]);
        $appointment->delete();
        return $this->returnSuccess('Appointment Deleted Successfully.');
    }
}
