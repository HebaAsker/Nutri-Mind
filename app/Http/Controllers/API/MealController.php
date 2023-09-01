<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\MealRequest;
use App\Models\Meal;
use App\Traits\GeneralTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    use GeneralTrait;
    use ImageTrait;

    public function index(Request $request)
    {
        return $this->getData($request, 'App\Models\Meal', true);
    }

    public function store(MealRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'), 'images/meals');
        }

        $meal = Meal::create($request->all());

        if (isset($imagePath)) {
            $meal->update([
                'image' => $imagePath,
            ]);
        }

        return $this->returnSuccess('Meal added successfully.');
    }

    public function destroy($mealId)
    {
        return $this->destroyData($mealId, 'App\Models\Meal', 'meals');
    }
}
