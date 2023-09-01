<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
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
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer|exists:patients,id',
        ], [
            'patient_id.*' => 'You are not authorized to access this information.',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $notes = Note::where('patient_id', $request->patient_id)->get()->sortByDesc('updated_at');

        return $this->returnData('notes', $notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $validated = $request->validated();

        if (!isset($request->title) && isset($request->body)) {
            Note::create([
                'title' => substr($request->body, 0, 255),
                'body' => $request->body,
                'patient_id' => $request->patient_id
            ]);
        } else if (isset($request->title) && !empty($request->title)) {
            Note::create(
                $request->only(['patient_id', 'title', 'body'])
            );
            return $this->returnSuccess('Note added Successfully.');
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
    public function update(NoteRequest $request, Note $note)
    {
        $validated = $request->validated();

        if (!isset($request->title) && isset($request->body)) {
            $note->update([
                'title' => substr($request->body, 0, 255),
                'body' => $request->body,
                'patient_id' => $request->patient_id
            ]);
        } else if (isset($request->title) && !empty($request->title)) {
            $note->update(
                $request->only(['patient_id', 'title', 'body'])
            );
        }
        return $this->returnSuccess('Note updated Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($noteId)
    {
        $validator = Validator::make(['id' => $noteId], [
            'id' => 'required|integer|exists:notes,id',
        ], [
            'id.*' =>  'You are not authorized to access this information.'
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $note = Note::find($noteId);
        $note->delete();

        return $this->returnSuccess('Note deleted successfully.');
    }
    //Search for specific note in search box
    public function search(NoteRequest $request)
    {
        $validated = $request->validated();

        $body_filter = $request->body;
        $title_filter = $request->title;

        $note = Note::query()
            ->where('body', 'LIKE', "%{$body_filter}%")
            ->orwhere('title', 'LIKE', "%{$title_filter}%")
            ->get();
        return $this->returnData('note', $note);
    }
}
