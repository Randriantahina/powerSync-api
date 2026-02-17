<?php

namespace App\Http\Controllers;

use App\DTOs\TaskDTO;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->all());
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $dto = new TaskDTO($data);

        return response()->json($this->service->create($dto), 201);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $dto = new TaskDTO($request->validated());

        return response()->json($this->service->update($task, $dto));
    }

    public function destroy(Task $task)
    {
        $this->service->delete($task);

        return response()->json(['message' => 'Task deleted']);
    }
}
