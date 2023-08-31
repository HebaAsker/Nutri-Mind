<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorWorkTime extends Model
{
    use HasFactory;
    protected $fillable=['date','time','status','doctor_id'];
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
