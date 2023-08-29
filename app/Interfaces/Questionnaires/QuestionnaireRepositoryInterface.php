<?php
namespace App\Interfaces\Questionnaires;

use Illuminate\Http\Request;



interface QuestionnaireRepositoryInterface
{
    public function answer(Request $request);
}
