<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PatientMealRequest;
use App\Traits\GeneralTrait;
use App\Traits\MealOperationsTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatientSelectedMealController extends Controller
{
    use GeneralTrait;
    use MealOperationsTrait;
    public function index(Request $request)
    {
        return $this->view($request,'App\Models\PatientSelectedMeal');
    }

    public function store(Request $request)
    {
        return $this->save($request,'App\Models\PatientSelectedMeal','App\Models\PatientSavedMeal','patient_saved_meals');
    }
    public function destroy($PatientSelectedMealId)
    {
        return $this->destroyData($PatientSelectedMealId,'App\Models\PatientSelectedMeal','patient_selected_meals');
    }
}
