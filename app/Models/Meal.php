<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $fillable=['name','calories','protein','fats','carbs','time','date','type','image','patient_id'];
}
