<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meal extends Model
{
    use HasFactory;
    protected $fillable=['name','calories','protein','fats','carbs','time','date','type','image','patient_id'];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
