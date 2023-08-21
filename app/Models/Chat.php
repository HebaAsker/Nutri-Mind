<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = "messages";
    protected $fillable = [
        'content',
        'patient_id',
        'doctor_id',
        'status'
    ];


    public function doctor()
  {
    return $this->belongsTo(Doctor::class, 'doctor_id');
  }

  public function patient()
  {
    return $this->belongsTo(Patient::class, 'patient_id');
  }


}
