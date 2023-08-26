<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payments = payment::all();

        $queryParams = $request->query();

        // payments will be return if doctor or patient ask for
        foreach ($queryParams as $key => $value) {
            $payments = $payments->where($key, $value);
        }
        $payments=Payment::all();
        return $this->returnData('payments',$payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctor=(object)[
            'id'=>1
        ];
        $patient=(object)[
            'id'=>1
        ];
        return view('payment.create',compact(['doctor','patient']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if card is valid or not
        $rules = [
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:paid,not paid',
            'card_number' => 'required|string|min:16|max:16',
            'CVV' => 'required|string|min:3|max:3',
            'ex_date' => 'required|date',
            'payment_method' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        Payment::create($request->all());

        return $this->returnSuccess('Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return $this->returnData('payment',$payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return $this->returnData('payment',$payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        // Validation rules
        $rules = [
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:paid,not paid',
            'card_number' => 'required|string|min:16|max:16',
            'CVV' => 'required|string|min:3|max:3',
            'ex_date' => 'required|date',
            'payment_method' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $payment->update($request->all());

        return $this->returnSuccess('Payment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
    }
}
