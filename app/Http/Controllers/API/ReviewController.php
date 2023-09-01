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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->getData($request, 'App\Models\Review',false);
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
        $validated=$request->validated();

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
    public function destroy($reviewId)
    {
        $this->destroyData($reviewId,'App\Models\Review','reviews');
    }
}
