<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Database\Seeders\ChatSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\MessageSeeder;
use Database\Seeders\PatientSeeder;
=======
>>>>>>> 500c997b32e9126b6193db74114324d168009175

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $this->call([
            DoctorSeeder::class,
            PatientSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
        ]);
=======
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
>>>>>>> 500c997b32e9126b6193db74114324d168009175
    }
}
