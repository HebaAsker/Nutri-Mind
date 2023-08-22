<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ChatSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\MessageSeeder;
use Database\Seeders\PatientSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DoctorSeeder::class,
            PatientSeeder::class,
<<<<<<< HEAD
            ChatSeeder::class,
=======
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
            MessageSeeder::class,
        ]);
    }
}
