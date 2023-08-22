<?php

namespace Database\Factories;

<<<<<<< HEAD
use App\Models\Chat;
=======
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
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
<<<<<<< HEAD
            'chat_id' => Chat::all()->random()->id,
            'status' => fake()->randomElement(['read','unread']),
            'content' => fake()->sentence(10),
            'sender_name' => Doctor::all()->random()->name,
            'receiver_name' => Patient::all()->random()->name,
=======
            'status' => fake()->randomElement(['read', 'unread']),
            'content' => fake()->sentence(10),
            'doctor_id' => Doctor::all()->random()->id,
            'patient_id' => Patient::all()->random()->id,
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
        ];
    }
}
