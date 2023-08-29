<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionnaire extends Model
{
    use HasFactory;

    protected $table = "questionnaires";
    protected $guarded = [];

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
