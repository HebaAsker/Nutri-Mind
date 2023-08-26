<h1>Available Times</h1>
<?php
$c=1;
$doctor=(object)[
    'id'=>1
];
?>
<form action="{{ route('doctor_work_times.store') }}" method="POST">
    @csrf
    @method('post')
    <input type="date" name="date">
    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
  <div id="available-times">
    <input type="checkbox" name="available_times[{{$c++}}]" value="00:00" checked> 00:00
    <input type="checkbox" name="available_times[{{$c++}}]" value="00:30"> 00:30
    <input type="checkbox" name="available_times[{{$c++}}]" value="01:00"> 01:00
    <input type="checkbox" name="available_times[{{$c++}}]" value="01:30"> 01:30
    {{-- up to 23:30 --}}
  </div>

  <button type="submit">Submit</button>
</form>
