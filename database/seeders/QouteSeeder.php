<?php

namespace Database\Seeders;

use App\Models\Qoute;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qoutes = [
            ['qoute'=>"You’ve gotta dance like there’s nobody watching, love like you’ll never be hurt, sing like there’s nobody listening, and live like it’s heaven on earth. ", 'author'=>" William W. Purkey"],
            ['qoute'=>"Fairy tales are more than true: not because they tell us that dragons exist, but because they tell us that dragons can be beaten. ", 'author'=>"Neil Gaiman "],
            ['qoute'=>"Everything you can imagine is real. ", 'author'=>" Pablo Picasso"],
            ['qoute'=>"When one door of happiness closes, another opens; but often we look so long at the closed door that we do not see the one which has been opened for us. ", 'author'=>"Helen Keller"],
            ['qoute'=>"Do one thing every day that scares you. ", 'author'=>"Eleanor Roosevelt "],
            ['qoute'=>"“It’s no use going back to yesterday, because I was a different person then. ", 'author'=>"Lewis Carroll "],
            ['qoute'=>" Smart people learn from everything and everyone, average people from their experiences, stupid people already have all the answers.", 'author'=>"Socrates "],
            ['qoute'=>"Do what you feel in your heart to be right―for you’ll be criticized anyway. ", 'author'=>"Eleanor Roosevelt "],
            ['qoute'=>"Happiness is not something ready made. It comes from your own actions. ", 'author'=>"Dalai Lama XIV "],
            ['qoute'=>"Whatever you are, be a good one. ", 'author'=>"Abraham Lincoln "],
            ['qoute'=>"If we have the attitude that it’s going to be a great day it usually is. ", 'author'=>" Catherine Pulsifier"],
            ['qoute'=>"Impossible is just an opinion ", 'author'=>" Paulo Coelho"],
            ['qoute'=>"Your passion is waiting for your courage to catch up. ", 'author'=>"Isabelle Lafleche "],
            ['qoute'=>"Magic is believing in yourself. If you can make that happen, you can make anything happen. ", 'author'=>"Johann Wolfgang Von Goethe "],
            ['qoute'=>"If something is important enough, even if the odds are stacked against you, you should still do it. ", 'author'=>" Elon Musk"],
            ['qoute'=>" Don’t be afraid to give up the good to go for the great.", 'author'=>"John D. Rockefeller "],
            ['qoute'=>"The hard days are what make you stronger. ", 'author'=>" Aly Raisman"],
            ['qoute'=>"If you believe it’ll work out, you’ll see opportunities. If you don’t believe it’ll work out, you’ll see obstacles. ", 'author'=>"Wayne Dyer "],
            ['qoute'=>" Keep your eyes on the stars, and your feet on the ground.", 'author'=>" Theodore Roosevelt"],
            ['qoute'=>"You can waste your lives drawing lines. Or you can live your life crossing them. ", 'author'=>"Shonda Rhimes "],
            ['qoute'=>" You’ve got to get up every morning with determination if you’re going to go to bed with satisfaction.", 'author'=>" George Lorimer"],
            ['qoute'=>" I now tried a new hypothesis: It was possible that I was more in charge of my happiness than I was allowing myself to be.", 'author'=>" Michelle Obama"],
            ['qoute'=>"In a gentle way, you can shake the world. ", 'author'=>" Mahatma Gandhi"],
            ['qoute'=>" If opportunity doesn’t knock, build a door.", 'author'=>"Kurt Cobain "],

        ];

        foreach ($qoutes as $qoute) {
            Qoute::create(['qoute' => $qoute['qoute'], 'author' => $qoute['author']]);
        }
    }
}
