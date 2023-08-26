<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Doctor;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reviews = Review::all();

        $queryParams = $request->query();

        // i make it in that way so i can
        // return specific doctor's review
        // return review for specific patient to specific doctor
        foreach ($queryParams as $key => $value) {
            $reviews = $reviews->where($key, $value);
        }

        return $this->returnData('reviews', $reviews);
        // return view('reviews.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'rate' => 'required|integer|between:1,5'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        try {
            // if already rated => update
            $review = Review::where(
                $request->only(['doctor_id','patient_id'])
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


    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return $this->returnData('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return $this->returnData('review', $review);
        // return view('reviews.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        // Validation rules
        $rules = [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'rate' => 'required|integer|between:1,5'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        $review->update(
            $request->all()
        );
        $averagerate = Review::where('doctor_id', $request->doctor_id)
            ->avg('rate');
        Doctor::where('id', $request->doctor_id)->Update(['rate' => $averagerate]);
        return $this->returnSuccess('Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return $this->returnSuccess('Review ddeleted successfully.');
    }
}
