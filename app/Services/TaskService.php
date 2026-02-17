<?php

namespace App\Services;

use App\DTOs\TaskDTO;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    protected $repo;

    public function __construct(TaskRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function create(TaskDTO $dto): Task
    {
        return $this->repo->create($dto);
    }

    public function find(int $id): ?Task
    {
        return $this->repo->find($id);
    }

    public function update(Task $task, TaskDTO $dto): Task
    {
        return $this->repo->update($task, $dto);
    }

    public function delete(Task $task): void
    {
        $this->repo->delete($task);
    }
}
