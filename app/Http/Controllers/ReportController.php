<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Report;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */

    // used to see all reports of a patient
    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\Report');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $validated=$request->validated();
        Report::create($request->all());
        return $this->returnSuccess('Report added successfully.');
    }

    /**
     * Display the specified resource.
     */

    // used to see report of specific appointment
    public function show($appointmentId)
    {
        return $this->viewOne($appointmentId,'App\Models\Report','reports','appointment_id');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated=$request->validated();
        $report->update($request->all());
        return $this->returnSuccess('Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reportId)
    {
        return $this->destroyData($reportId,'App\Models\Report','reports');
    }
}
