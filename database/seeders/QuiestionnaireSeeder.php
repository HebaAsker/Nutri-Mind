<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Database\Seeder;


class QuiestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Request $request)
    {
    //     $questions = [
    //         ['question' => 'How are you feeling today?',
    //             'options' =>
    //                 ['option' => 'Not Bad'],
    //                 ['option' => 'Good'],
    //                 ['option' => 'Nice'],
    //                 ['option' => 'Very good'],
    //         ],
    //         ['question' => 'Are you on your diet program?',
    //             'options' =>
    //                 ['option' => 'Yes'],
    //                 ['option' => 'No'],
    //                 ['option' => 'Yes, but want to change'],
    //         ],
    //         'question' => 'What is your weight today? Are you satisfied with it?',
    //         'question' => 'Tell me things made you bad or eating more today'
    //     ];

    //     foreach ($questions as $question) {
    //         Questionnaire::create(
    //             [   'question' => $question['question'],
    //                 'options' => $question['option[]']
    //             ]
    //         );
    //     }
    //     return
    //     [
    //         'question_id' => Questionnaire::all()->random()->id,
    //     ];
    }
}
