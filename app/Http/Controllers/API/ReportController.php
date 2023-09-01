<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Appointment;
use App\Models\Report;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    use GeneralTrait;

    // store and update
    // appointment_id, disease, description => request
    // done in report page
    public function store(ReportRequest $request)
    {
        $validated = $request->validated();
        $report = Report::where('appointment_id',$request->appointment_id)->first();
        if (empty($report)) {
            Report::create($request->all());
            return $this->returnSuccess('Report added successfully.');
        } else {
            $report->update($request->all());
            return $this->returnSuccess('Report updated successfully.');
        }
    }

    // used to see report of specific appointment
    // report page
    public function show($appointmentId)
    {
        $validator = Validator::make(['id' => $appointmentId], [
            'id' => "integer",
        ], [
            'id.integer' => 'You are not authorized to access this information.'
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        $report = Appointment::join('doctor_work_times', 'appointments.doctor_work_time_id', '=', 'doctor_work_times.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('reports', 'appointments.id', '=', 'reports.appointment_id')
            ->orderBy('date')
            ->where('appointments.id',$appointmentId)
            ->first([
                "full_name",
                "age",
                "diagnosis_of_his_state",
                "description",
                "appointment_id"
    ]);
        return $this->returnData('report',$report);
    }

    public function destroy($reportId)
    {
        return $this->destroyData($reportId, 'App\Models\Report', 'reports');
    }
}
