<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $appointments = Appointment::all();

        $queryParams = $request->query();

        // appointments will be return if doctor or patient ask for
        foreach ($queryParams as $key => $value) {
            $appointments = $appointments->where($key, $value);
        }

        return $this->returnData('appointments', $appointments);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctorWorkTime = (object) [
            'id' => 1
        ];
        $doctor = (object) [
            'id' => 1
        ];
        $patient = (object) [
            'id' => 1
        ];
        $payment = (object) [
            'id' => 1
        ];
        return view('Appointments.create', compact(['doctorWorkTime', 'doctor', 'patient', 'payment']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation rules
    $rules = [
        'full_name' => 'required|string|max:255',
        'age' => 'required|integer',
        'doctor_work_time_id' => [
            'required',
            'integer',
            'exists:doctor_work_times,id',
            'unique:appointments,doctor_work_time_id'
        ],
        'doctor_id' => 'required|integer|exists:doctors,id',
        'payment_id' => 'required|integer|exists:payments,id',
        'patient_id' => 'required|integer|exists:patients,id'
    ];
    $customMessages = [
        'doctor_work_time_id.unique' => 'That time is not available.'
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
        return $this->returnError($validator->errors());
    }

    Appointment::create($request->all());
    DoctorWorkTime::where('id',$request->doctor_work_time)->update([
        'status'=>'set'
    ]);

    return $this->returnSuccess('Appointment created successfully.');
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
    public function update(Request $request, Appointment $appointment)
    {
        DoctorWorkTime::where('id',$appointment->doctor_work_time)->update([
            'status'=>'not set'
        ]);
        $rules = [
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'doctor_work_time_id' => [
                'required',
                'integer',
                'exists:doctor_work_times,id',
                'unique:appointments,doctor_work_time_id'
            ],
            'doctor_id' => 'required|integer|exists:doctors,id',
            'payment_id' => 'required|integer|exists:payments,id',
            'patient_id' => 'required|integer|exists:patients,id'
        ];
        $customMessages = [
            'doctor_work_time_id.unique' => 'That time is not available.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        // Update the appointment
        $appointment->update($request->all());
        DoctorWorkTime::where('id',$request->doctor_work_time)->update([
            'status'=>'set'
        ]);

        return $this->returnSuccess('Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        // payment we need to give the patient his money again, will work in that after paypal
        DoctorWorkTime::where('id',$appointment->doctor_work_time)->update([
            'status'=>'not set'
        ]);
        $appointment->delete();
    }
}
