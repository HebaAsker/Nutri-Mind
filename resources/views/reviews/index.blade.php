@foreach ($reviews as $review)
<div>
    <a href="{{ route('reviews.edit',$review->id) }}">Edit</a>
    <form action="{{ route('reviews.destroy',$review->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
    </form>
    <h2>{{ $review->rate }}</h2>
</div>
<br><br>
@endforeach

