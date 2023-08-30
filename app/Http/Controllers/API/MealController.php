<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\MealRequest;
use App\Models\Meal;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
        ], [
            'patient_id.*' => 'You are not authorized to access this information.',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        } else {
            $meals = Meal::where('patient_id', $request->patient_id)->get();

            return $this->returnData('meals', $meals);
        }
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
    public function store(MealRequest $request)
    {
        $validated=$request->validated();

        Meal::create($request->all());

        return $this->returnSuccess('Meal added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        return $this->returnData('Meal',$meal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        return $this->returnData('Meal',$meal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {
        $validated=$request->validated();

        $meal->update($request->all());

        return $this->returnSuccess('Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return $this->returnSuccess('Meal deleted successfully.');
    }
}
