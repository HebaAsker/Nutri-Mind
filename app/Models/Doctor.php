<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Chat;
use App\Models\Patient;
use App\Models\SocialAccount;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='doctors';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone',
        'rate',
        'national_id',
        'qualification',
        'experience_years',
        'appointments',


    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function patients()
    {
        return $this->belongsToMany(Patient::class,'patients');
    }


    public function socialAccounts() : HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
>>>>>>> 500c997b32e9126b6193db74114324d168009175
}
