<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Models\PatientSavedMeal;
use App\Traits\GeneralTrait;
use App\Traits\MealOperationsTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientSavedMealController extends Controller
{
    use GeneralTrait;
    use MealOperationsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->view($request,'App\Models\PatientSavedMeal');
    }

    public function store(Request $request)
    {
        return $this->save($request,'App\Models\PatientSavedMeal','App\Models\PatientSuggestedMeal','patient_suggested_meals');
    }
}
