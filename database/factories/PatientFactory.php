<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{


    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image' => fake()->image,
            'height' => fake()->randomElement([178,167,150,134,195]),
            'weight' => fake()->randomElement([78,67,50,34,95]),
            'age' => fake()->randomElement([20,17,15,34,55]),
            'gender' => fake()->randomElement(['male', 'female']),
            'verfication_code' => fake()->randomElement([1025,5592,2173,4687,4255]),
        ];
    }
}
