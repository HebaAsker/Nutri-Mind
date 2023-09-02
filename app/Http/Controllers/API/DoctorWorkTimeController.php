<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorWorkTimeRequest;
use App\Models\DoctorWorkTime;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorWorkTimeController extends Controller
{
    use GeneralTrait;

    // in the above of book an appointment
    public function index(Request $request)
    {
        return $this->getData($request,'App\Models\DoctorWorkTime',false);
    }

    //doctor choose time to work
    public function store(DoctorWorkTimeRequest $request)
    {
        $validated=$request->validated();
        DoctorWorkTime::create($request->all());
        return $this->returnSuccess("Time added successfully");
    }

}
