<?php

namespace App\Models;

use App\Models\DoctorWorkTime;
use App\Models\Patient;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=['full_name','age','doctor_work_time_id','doctor_id','payment_id','patient_id'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctorWorkTime(): HasOne
    {
        return $this->hasOne(DoctorWorkTime::class);
    }
    public function report(): HasOne
    {
        return $this->hasOne(Report::class);
    }
}
