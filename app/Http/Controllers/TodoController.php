<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Task $task)
    {
        $tasks = Task::orderBy("status", 'desc')->get();
        $task2do = Task::where('status', 0)->get();
        $taskdone = Task::where('status', 1)->get();
        return view('todo', [
            'tasks' => $tasks,
            'task2do' => $task2do,
            'taskdone' => $taskdone,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            // task validations
            'task' => 'required',
        ]);
        Task::create([
            'task' => Request('task'),
        ]);
        return back();
    }
    public function done($id, Request $request)
    {
        $tocheck = Task::where('id', $id)->get();
        foreach ($tocheck as $checktask) {
            if ($checktask->status == 1) {
                Task::where('id', $id)->update([
                    'status' => 0,
                ]);
                return back();
            }
        }
        Task::where('id', $id)->update([
            'status' => 1,
        ]);
        return back();
    }
    public function destroy($id, Request $request)
    {
        Task::where('id', $id)->delete();
        return back();
    }
    public function destroyAll()
    {
        Task::truncate();
        return back();
    }
}