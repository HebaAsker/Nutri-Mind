<?php

namespace App\Models;

use App\Models\Option;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $table = "answers";
    protected $guarded = [];


    public function question() {
        return $this->belongsTo(Questionnaire::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
