<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::orderBy('priority','desc')->get()]);
    }

    public function store(Request $r)
    {
        $data = $r->validate(['title'=>'required|string|max:255','notes'=>'nullable|string','priority'=>'nullable|integer']);
        $task = Task::create($data);
        if($r->wantsJson()) return response()->json($task,201);
        return redirect()->back();
    }

    public function update(Request $r, Task $task)
    {
        $data = $r->validate(['title'=>'required|string','notes'=>'nullable|string','is_done'=>'nullable|boolean','priority'=>'nullable|integer']);
        $task->update($data);
        if($r->wantsJson()) return response()->json($task);
        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}