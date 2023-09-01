<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSuggestedMeal;
use App\Models\SuggestedMeal;
use App\Traits\GeneralTrait;
use App\Traits\MealOperationsTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PatientSuggestedMealController extends Controller
{
    use GeneralTrait;
    use MealOperationsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->view($request,'App\Models\PatientSuggestedMeal');
    }
    public function store(PatientMealRequest $request)
    {
        $validated=$request->validated();

        PatientSuggestedMeal::create($request->only(['patient_id','meal_id']));

        return $this->returnSuccess('Meal added successfully.');
    }
}
