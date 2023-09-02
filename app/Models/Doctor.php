<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Payment;
use App\Models\Review;
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
    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function socialAccounts() : HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function appointment() : HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function doctorSetTime(): HasMany
    {
        return $this->hasMany(DoctorSetTime::class);
    }
    public function doctorWorkTime(): HasMany
    {
        return $this->hasMany(DoctorWorkTime::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function generateOtpCode(){
        //when doctor login
        $this->timestamps = false;
        $this->verfication_code = rand(1000,6000);
        $this->expire_at = now()->addMinutes(5);
        $this->save();
    }
}
