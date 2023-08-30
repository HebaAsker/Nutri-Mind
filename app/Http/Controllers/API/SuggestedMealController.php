<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestedMealRequest;
use App\Models\SuggestedMeal;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SuggestedMealController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = SuggestedMeal::all('*');
        $this->returnData('meals', $meals);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SuggestedMealRequest $request)
    {
        $validated=$request->validated();
        SuggestedMeal::create($request->all());
        return $this->returnSuccess('Meal added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuggestedMeal $suggestedMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuggestedMeal $suggestedMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuggestedMealRequest $request, SuggestedMeal $suggestedMeal)
    {
        $validated=$request->validated();
        $suggestedMeal->update($request->all());
        return $this->returnSuccess('Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($suggestedMealId)
    {
        return $this->destroyData($suggestedMealId,'App\Models\SuggestedMeal','suggested_meals');
    }
}
