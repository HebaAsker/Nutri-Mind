<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorWorkTime extends Model
{
    use HasFactory;
    protected $fillable=['date','time','status','doctor_id'];
}
