<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\SuggestedMeal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientSuggestedMeal extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','meal_id','status'];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function suggestedMeal(): BelongsTo
    {
        return $this->belongsTo(SuggestedMeal::class);
    }
}
