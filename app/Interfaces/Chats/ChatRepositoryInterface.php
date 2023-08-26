<?php
namespace App\Interfaces\Chats;

use App\Http\Requests\MessageRequest;


interface ChatRepositoryInterface
{

    // Create new chat method
    public function create(MessageRequest $request);

}
