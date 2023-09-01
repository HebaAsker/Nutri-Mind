<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Chats\ChatRepository;
use App\Repository\Calories\CaloriesRepository;
use App\Interfaces\Chats\ChatRepositoryInterface;
use App\Repository\Authentication\DoctorAuthRepository;
use App\Interfaces\Calories\CaloriesRepositoryInterface;
use App\Repository\Authentication\PatientAuthRepository;
use App\Repository\Questionnaires\QuestionnaireRepository;
use App\Interfaces\Authentication\DoctorAuthRepositoryInterface;
use App\Interfaces\Authentication\PatientAuthRepositoryInterface;
use App\Interfaces\Questionnaires\QuestionnaireRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
        $this->app->bind(QuestionnaireRepositoryInterface::class, QuestionnaireRepository::class);
        $this->app->bind(DoctorAuthRepositoryInterface::class, DoctorAuthRepository::class);
        $this->app->bind(PatientAuthRepositoryInterface::class, PatientAuthRepository::class);
        $this->app->bind(CaloriesRepositoryInterface::class, CaloriesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
