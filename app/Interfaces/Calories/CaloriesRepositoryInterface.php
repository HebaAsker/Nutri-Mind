<?php
namespace App\Interfaces\Calories;



interface CaloriesRepositoryInterface
{

    // Calculate patient calories
    public function calculate();

    // Recommend calories patient need to loos or gain weight
    public function recommendedCalories();
}
