<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Report;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use GeneralTrait;

    // used to see all reports of a patient
    public function index(Request $request)
    {
        return $this->getData($request, 'App\Models\Report');
    }

    // store and update
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
    public function show($appointmentId)
    {
        return $this->viewOne($appointmentId, 'App\Models\Report', 'reports', 'appointment_id');
    }

    public function destroy($reportId)
    {
        return $this->destroyData($reportId, 'App\Models\Report', 'reports');
    }
}
