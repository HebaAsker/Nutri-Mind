<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use GeneralTrait;

    // payment
    public function store(PaymentRequest $request)
    {
        // check if card is valid or not... need to be added after paypal
        $validated=$request->validated();

        Payment::create($request->all());

        return $this->returnSuccess('Payment created successfully.');
    }

    public function edit($paymentId)
    {
        return $this->viewOne($paymentId,'App\Models\Payment','payments','id');
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $validated=$request->validated();


        $payment->update($request->all());

        return $this->returnSuccess('Payment updated successfully.');
    }

}
