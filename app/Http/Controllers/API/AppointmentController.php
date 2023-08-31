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

    // my scheduale
    // $request=>doctor_id, date
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'date' => 'required|date',
        ], [
            'doctor_id.*' => 'You are not authorized to access this information.',
            'date.*' => 'You are not authorized to access this information.'
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $appointments = Appointment::join('doctor_work_times', 'appointments.doctor_work_time_id', '=', 'doctor_work_times.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('reports', 'appointments.id', '=', 'reports.appointment_id')
            ->where('appointments.doctor_id', $request->doctor_id)
            ->where('date', $request->date)
            ->orderBy('time')
            ->get([
                "full_name",
                "time",
                "diagnosis_of_his_state",
                "description",
                "appointment_id"
            ]);

        return $this->returnData('appointments', $appointments);
    }


    // book an appointment
    // $request => doctor_work_time_id, full_name, age, doctor_id, patient_id, payment_id
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();

        Appointment::create($request->except(['age']));
        DoctorWorkTime::where('id', $request->doctor_work_time_id)->update([
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
            'doctor_work_time_id.*' => 'You are not authorized to access this information..',
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
    public function patient_info($appointmentId)
    {
        $validator = Validator::make(['id' => $appointmentId], [
            'id' => "integer",
        ], [
            'id.integer' => 'You are not authorized to access this information.'
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $info = Appointment::join('doctor_work_times', 'appointments.doctor_work_time_id', '=', 'doctor_work_times.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('reports', 'appointments.id', '=', 'reports.appointment_id')
            ->orderBy('date')
            ->where('appointments.id', $appointmentId)
            ->first([
                "full_name",
                "time",
                "age",
                "gender",
                "diagnosis_of_his_state",
                "description",
                "appointment_id"
            ]);
        return $this->returnData('info', $info);
    }
}
