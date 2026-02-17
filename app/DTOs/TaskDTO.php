<?php

namespace App\DTOs;

class TaskDTO
{
    public string $title;

    public ?int $user_id;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->user_id = $data['user_id'] ?? null;
    }
}
