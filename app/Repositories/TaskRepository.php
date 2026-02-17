<?php

namespace App\Repositories;

use App\DTOs\TaskDTO;
use App\Models\Task;

class TaskRepository
{
    public function all()
    {
        return Task::all();
    }

    public function create(TaskDTO $dto): Task
    {
        return Task::create([
            'title' => $dto->title,
            'user_id' => $dto->user_id,
        ]);
    }

    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    public function update(Task $task, TaskDTO $dto): Task
    {
        $task->update([
            'title' => $dto->title,
        ]);

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
