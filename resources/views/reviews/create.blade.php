<form action="{{ route('reviews.store') }}" method="post">
    @csrf
    @method('POST')
    <input type="hidden" name="doctor_id" placeholder="Dr Id" value="1"> {{-- that value will be taken with jquery --}}
    <input type="hidden" name="patient_id" placeholder="Patient Id" value="1">

    <div class="star-rate">
        <input type="radio" name="rate" value="1">
        <label for="rate-1"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="2">
        <label for="rate-2"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="3">
        <label for="rate-3"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="4">
        <label for="rate-4"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="5">
        <label for="rate-5"><span class="far fa-star"></span></label>
    </div>

    <button type="submit">Submit</button>
</form>
