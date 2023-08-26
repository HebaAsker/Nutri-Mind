<form action="{{ route('appointment.store') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
      <label for="full_name">Full name</label>
      <input type="text" name="full_name" id="full_name" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="age">Age</label>
      <input type="number" name="age" id="age" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="doctor_work_time_id">Doctor work time</label>
      <input type="hidden" name="doctor_work_time_id" id="doctor_work_time_id" value="{{ $doctorWorkTime->id }}">
    </div>

    <div class="form-group">
      <label for="doctor_id">Doctor</label>
      <input type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor->id }}">
    </div>

    <div class="form-group">
      <label for="payment_id">Payment</label>
      <input type="hidden" name="payment_id" id="payment_id" value="{{ $payment->id }}">
    </div>

    <div class="form-group">
      <label for="patient_id">Patient</label>
      <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
