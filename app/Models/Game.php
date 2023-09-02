<?php

namespace App\Models;

use App\Models\Mood;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;
    protected $fillable=['date_time','mood_id','patient_id'];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function mood(): BelongsTo
    {
        return $this->belongsTo(Mood::class);
    }
}
