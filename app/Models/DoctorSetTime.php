<?php

namespace App\Models;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DoctorSetTime extends Model
{
    use HasFactory;
    protected $fillable=['date','time','status','doctor_id'];
    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
