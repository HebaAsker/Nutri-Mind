<form action="{{ route('payment.store') }}" method="post">
    @csrf

    <div class="form-group">
      <label for="price">Price</label>
      <input type="number" name="price" id="price" class="form-control" step="0.01" required>
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <select name="status" id="status" class="form-control">
        <option value="paid">Paid</option>
        <option value="not paid">Not paid</option>
        <option value="partially paid">Partially paid</option>
      </select>
    </div>

    <div class="form-group">
      <label for="card_number">Card number</label>
      <input type="text" name="card_number" id="card_number" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="CVV">CVV</label>
      <input type="text" name="CVV" id="CVV" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="ex_date">Expiration date</label>
      <input type="date" name="ex_date" id="ex_date" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="payment_method">Payment method</label>
      <input type="text" name="payment_method" id="payment_method" class="form-control" required>
    </div>

    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
