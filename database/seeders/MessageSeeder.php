<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Message;
=======
use App\Models\Chat;
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
use Illuminate\Database\Seeder;


class MessageSeeder extends Seeder
{

    public function run(): void
    {
<<<<<<< HEAD
        Message::factory()->count(6)->create();
=======
        Chat::factory()->count(6)->create();
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22
    }
}
