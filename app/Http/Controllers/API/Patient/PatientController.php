<?php

namespace App\Http\Controllers\API\Patient;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PatientController extends Controller
{
    // display some doctors in user home page
    public function index(){
        $doctors = Doctor::paginate(8);
        return $doctors;
    }

    //display specific doctor information page when patient click on doctor profile
    public function show($id){
        $doctor = Doctor::findOrFail($id);
        return $doctor;
    }

    //Search for specific doctor page in search box
    public function search(Request $request){
        $filter = $request->name;
        $doctor = Doctor::query()
            ->where('name', 'LIKE', "%{$filter}%")
            ->get();
        return $doctor;
    }
}
