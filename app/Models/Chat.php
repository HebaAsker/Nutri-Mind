<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = "chats";
    protected $guarded = [];



=======
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
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22


}
