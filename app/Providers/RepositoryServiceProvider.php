<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Chats\ChatRepository;
use App\Interfaces\Chats\ChatRepositoryInterface;
use App\Repository\Questionnaires\QuestionnaireRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
