@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('notes.store') }}" method="POST">
    @csrf
    @method('POST')
    <input type="text" name="title" placeholder="title" value="{{ old('title') }}">
    <input type="text" name="body" placeholder="body" value="{{ old('body') }}">
    <input type="hidden" name="patient_id" value="1">
    <button type="submit">Submit</button>
</form>
