<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $fillable=['diagnosis_of_his_state','description','appointment_id'];
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

}
