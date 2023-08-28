<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable=['doctor_id','patient_id','rate'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class,'patients');
    }

    public function doctor(){
        return  $this->belongsTo(Doctor::class);
    }
}
