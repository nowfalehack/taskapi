<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    // Standard JSON response
    private function response($status, $message, $data = null, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // 1. Create Task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => [
                'nullable',
                Rule::in(['pending', 'completed']),
            ],
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return $this->response(
            true,
            'Task created successfully',
            $task,
            201
        );
    }

    // 2. Retrieve All Tasks
    public function index()
    {
        $tasks = Task::latest()->get();

        return $this->response(
            true,
            'Tasks retrieved successfully',
            $tasks
        );
    }

    // 3. Retrieve Single Task
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->response(
                false,
                'Task not found',
                null,
                404
            );
        }

        return $this->response(
            true,
            'Task retrieved successfully',
            $task
        );
    }

    // 4. Update Task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->response(
                false,
                'Task not found',
                null,
                404
            );
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => [
                'sometimes',
                'required',
                Rule::in(['pending', 'completed']),
            ],
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return $this->response(
            true,
            'Task updated successfully',
            $task
        );
    }

    // 5. Delete Task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->response(
                false,
                'Task not found',
                null,
                404
            );
        }

        $task->delete();

        return $this->response(
            true,
            'Task deleted successfully',
            null
        );
    }
}