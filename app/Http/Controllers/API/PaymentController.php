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
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return $this->getData($request, 'App\Models\Payment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        // check if card is valid or not... need to be added after paypal
        $validated=$request->validated();

        Payment::create($request->all());

        return $this->returnSuccess('Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return $this->returnData('payment', $payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return $this->returnData('payment', $payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated=$request->validated();


        $payment->update($request->all());

        return $this->returnSuccess('Payment updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($paymentId)
    {
        return $this->destroyData($paymentId,'App\Models\Payment','payments');
    }
}
