<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSelectedMeal;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientSelectedMealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\PatientSelectedMeal');
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
        PatientSelectedMeal::create($request->all());
        return $this->returnSuccess('Meal added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientSelectedMeal $PatientSelectedMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientSelectedMeal $PatientSelectedMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientMealRequest $request, PatientSelectedMeal $PatientSelectedMeal)
    {
        $validated=$request->validated();
        $PatientSelectedMeal->update($request->all());
        return $this->returnSuccess('Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($PatientSelectedMealId)
    {
        return $this->destroyData($PatientSelectedMealId,'App\Models\PatientSelectedMeal','patient_selected_meals');
    }
}
