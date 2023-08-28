<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Chats\ChatRepository;
use App\Interfaces\Chats\ChatRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //admin
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
