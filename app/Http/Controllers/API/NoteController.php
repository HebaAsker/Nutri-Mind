<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all()->sortByDesc('updated_at');
        return $this->returnData('notes', $notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->only(['patient_id', 'title', 'body']);
        $rules = [
            'patient_id' => 'required|integer|exists:patients,id',
            'title' => [
                'max:255'
            ]
        ];
        $messages = [
            'patient_id.required'=>'Unathorized Access!',
            'title.max' => 'The title must not excced 255 characters'
        ];

        $validator = Validator::make($request->only(['patient_id', 'title', 'body']), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        if (!isset($request->title) && isset($request->body)){
            Note::create([
                'title' => substr($request->body, 0, 255),
                'body' => $request->body,
                'patient_id'=>$request->patient_id
            ]);
        }else if(isset($request->title)&&!empty($request->title)){
            Note::create(
                $request->only(['patient_id', 'title', 'body'])
            );
        return $this->returnSuccess('Note created Successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return $this->returnData('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return $this->returnData('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $rules = [
            'patient_id' => 'required|integer|exists:patients,id',
            'title' => [
                'max:255'
            ]
        ];
        $messages = [
            'title' => [
                'max:255'
            ]
        ];

        $validator = Validator::make($request->only(['patient_id', 'title', 'body']), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        if (!isset($request->title) && isset($request->body))
            $note->update([
                'title' => substr($request->body, 0, 255),
                'body' => $request->body,
                'patient_id'=>$request->patient_id
            ]);
        if (isset($request->title))
            $note->update(
                $request->only(['patient_id', 'title', 'body'])
            );
        return $this->returnSuccess('Note updated Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return $this->returnSuccess('Note deleted Successfully.');
    }
    //Search for specific note in search box
    public function search(Request $request){
        $body_filter = $request->body;
        $title_filter = $request->title;
        $note = Note::query()
            ->where('body', 'LIKE', "%{$body_filter}%")
            ->orwhere('title', 'LIKE', "%{$title_filter}%")
            ->get();
    return $note;
    }
}
