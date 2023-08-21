<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{


    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['read', 'unread']),
            'content' => fake()->sentence(10),
            'doctor_id' => Doctor::all()->random()->id,
            'patient_id' => Patient::all()->random()->id,
        ];
    }
}
