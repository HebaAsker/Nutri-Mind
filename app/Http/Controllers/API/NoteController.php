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

    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\Note',false);
    }

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

    public function edit($noteId)
    {
        return $this->viewOne($noteId,'App\Models\Note','notes','id');
    }

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
                $request->only(['title', 'body'])
            );
        }
        return $this->returnSuccess('Note updated Successfully.');
    }

    public function destroy($noteId)
    {
        return $this->destroyData($noteId,'App\Models\Note','notes');
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
            ->get('*');
        return $this->returnData('note', $note);
    }
}
