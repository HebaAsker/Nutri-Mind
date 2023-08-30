<?php

namespace App\Http\Controllers\API\Patient;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    // display some doctors in user home page
    public function index(){
        $doctors = Doctor::paginate(8);
        return response([
            'status' => true,
            $doctors
        ]);

    }

    //display specific doctor information page when patient click on doctor profile
    public function show($id){
        $doctor = Doctor::findOrFail($id);
        return response([
            'status' => true,
            $doctor
        ]);
    }

    //Search for specific doctor page in search box
    public function search(Request $request){
        $filter = $request->name;
        $doctor = Doctor::query()
            ->where('name', 'LIKE', "%{$filter}%")
            ->get();
        return response([
            'status' => true,
            $doctor
        ]);
    }

    //take patient height and weight then calculate user calories
    public function calculate(){
        $height = Patient::where('id',Auth::user()->id)->get('height');
        $weight = Patient::where('id',Auth::user()->id)->get('weight');
        $age = Patient::where('id',Auth::user()->id)->get('age');
        $gender = Patient::where('id',Auth::user()->id)->get('gender');
        if($gender == 'male'){
            $calories = ($weight*10)+($height*6.25)-($age*5)+5;
        }else{
            $calories = ($weight*10)+($height*6.25)-($age*5)-161;
        }
        return response([
            'status' => true,
            $height,
            $weight,
            $age,
            $gender,
            $calories,
        ]);
    }
}
