<?php

namespace App\Models;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages";
    protected $guarded = [];

    public function chat(){
        return  $this->belongsTo(Chat::class);
    }
}
