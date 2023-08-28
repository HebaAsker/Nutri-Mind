<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $table='options';
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
