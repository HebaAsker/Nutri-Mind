@foreach ($notes as $note)
<div>
    <a href="{{ route('notes.edit',$note->id) }}">Edit</a>
    <form action="{{ route('notes.destroy',$note->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
    </form>
    <h2>{{ $note->title }}</h2>
    <p>{{ $note->body }}</p>
</div>
<br><br>
@endforeach

