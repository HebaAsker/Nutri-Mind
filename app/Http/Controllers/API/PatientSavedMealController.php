<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSavedMeal;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientSavedMealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\PatientSavedMeal');
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
        PatientSavedMeal::create($request->all());
        return $this->returnSuccess('Meal added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientSavedMeal $PatientSavedMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientSavedMeal $PatientSavedMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientMealRequest $request, PatientSavedMeal $PatientSavedMeal)
    {
        $validated=$request->validated();
        $PatientSavedMeal->update($request->all());
        return $this->returnSuccess('Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($PatientSavedMealId)
    {
        return $this->destroyData($PatientSavedMealId,'App\Models\PatientSavedMeal','patient_saved_meals');
    }
}
