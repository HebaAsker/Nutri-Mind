<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSuggestedMeal;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientSuggestedMealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\PatientSuggestedMeal');
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
    public function store(PatientMealRequest $request)
    {
        $validated=$request->validated();
        PatientSuggestedMeal::create($request->all());
        return $this->returnSuccess('Meal added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientSuggestedMeal $patientSuggestedMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientSuggestedMeal $patientSuggestedMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientMealRequest $request, PatientSuggestedMeal $patientSuggestedMeal)
    {
        $validated=$request->validated();
        $patientSuggestedMeal->update($request->all());
        return $this->returnSuccess('Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($patientSuggestedMealId)
    {
        return $this->destroyData($patientSuggestedMealId,'App\Models\PatientSuggestedMeal','patient_suggested_meals');
    }
}
