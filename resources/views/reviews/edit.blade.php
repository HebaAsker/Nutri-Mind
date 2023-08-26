<form action="{{ route('reviews.update',$review->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="doctor_id" placeholder="Dr Id" value="1"> {{-- that value will be taken with jquery --}}
    <input type="hidden" name="patient_id" placeholder="Patient Id" value="1">

    <div class="star-rate">
        <input type="radio" name="rate" value="1" <?php
            if($review->rate==1)echo 'checked';
            ?>
            >
        <label for="rate-1"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="2"
        <?php
            if($review->rate==2)echo 'checked';
            ?>
        >
        <label for="rate-2"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="3"
        <?php
            if($review->rate==3)echo 'checked';
            ?>
        >
        <label for="rate-3"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="4"
        <?php
            if($review->rate==4)echo 'checked';
            ?>
        >
        <label for="rate-4"><span class="far fa-star"></span></label>
        <input type="radio" name="rate" value="5"
        <?php
            if($review->rate==5)echo 'checked';
            ?>
        >
        <label for="rate-5"><span class="far fa-star"></span></label>
    </div>

    <button type="submit">Submit</button>
</form>
