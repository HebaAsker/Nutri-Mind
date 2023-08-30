<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\MoodRequest;
use App\Models\Mood;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MoodController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moods = Mood::all();
        return $this->returnData('Moods', $moods);
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
    public function store(MoodRequest $request)
    {
        $validated = $request->validated();

        Mood::create($request->only('name'));

        return $this->returnSuccess('Mood added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mood $mood)
    {
        return $this->returnData('mood', $mood);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mood $mood)
    {
        return $this->returnData('mood', $mood);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoodRequest $request, Mood $mood)
    {
        $validated = $request->validated();

        $mood->update($request->only('name'));

        return $this->returnSuccess('Mood updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($moodId)
    {
        $validator = Validator::make(['id' => $moodId], [
            'id' => 'required|integer|exists:moods,id',
        ], [
            'id.required' => 'Please select the mood you want to delete.',
            'id.integer' => 'You are not authorized to access this information.',
            'id.exists' => 'The specified mood does not exist. Please provide a valid mood.',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $mood = Mood::find($moodId);
        $mood->delete();

        return $this->returnSuccess('Mood deleted successfully.');
    }
}
