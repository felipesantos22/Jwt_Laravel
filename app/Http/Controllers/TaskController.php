<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(){
        $task = $this->task->all();
        return $task;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $task = $this->task->create($validated);
            return $task;
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
