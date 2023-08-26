<form action="{{ route('notes.update',$note->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" placeholder="title" value="{{ $note->title }}" value="{{ old('title') }}">
    <input type="text" name="body" placeholder="body" value="{{ $note->body }}" value="{{ old('body') }}">
    <input type="hidden" name='patient_id' value="1">
    <button type="submit">update</button>
</form>
