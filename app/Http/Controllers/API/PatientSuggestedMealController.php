<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\patientMealIndexRequest;
use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSuggestedMeal;
use App\Traits\GeneralTrait;
use Illuminate\Routing\Controller;
class PatientSuggestedMealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(patientMealIndexRequest $request)
    {
        $validated=$request->validated();
        $meals=PatientSuggestedMeal::where('patient_id',$request->patient_id)->where('status',$request->status)->get();
        return $this->returnData('meals',$meals);
    }
    public function store(PatientMealRequest $request)
    {
        $validated=$request->validated();

        PatientSuggestedMeal::create($request->all());

        return $this->returnSuccess('Meal added successfully.');
    }
    public function update(PatientSuggestedMeal $patientSuggestedMeal)
    {
        if($patientSuggestedMeal->status=='suggested')
        {
            $patientSuggestedMeal->update(['status'=>'selected']);
        }else if($patientSuggestedMeal->status=='selected')
        {
            $patientSuggestedMeal->update(['status'=>'saved']);
        }else
        {
            $patientSuggestedMeal->update(['status'=>'suggested']);
        }

        return $this->returnSuccess('Meal added successfully.');
    }
}
