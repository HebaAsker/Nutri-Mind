<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Doctor;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        if(isset($request->id)&&!empty($request->id))
        return $this->viewOne($request->id, 'App\Models\doctor','doctors','id',true,'rate');
        else return $this->returnError('You are not authorized to access this information.');
    }

    public function store(ReviewRequest $request)
    {
        $validated=$request->validated();
        try {
            // if already rated => update
            $review = Review::where(
                $request->only(['doctor_id', 'patient_id'])
            )->firstOrFail();

            $review->update([
                'rate' => $request->rate
            ]);
        } catch (ModelNotFoundException $exception) {
            // if not rated => create new rate
            Review::create(
                $request->all()
            );
        }
        $averagerate = Review::where('doctor_id', $request->doctor_id)
            ->avg('rate');
        Doctor::where('id', $request->doctor_id)->Update(['rate' => $averagerate]);

        return $this->returnSuccess('Review added successfully.');
    }
}
