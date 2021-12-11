<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function checkCookies(Request $request)
    {
        $user_id = $request->cookie('todo_id');
        $task = Task::where('user_id', $user_id)->first();
        if (!$task) {
            function randomee($a)
            {
                $b = 1;
                $d = 'TD';
                while ($b <= $a) {
                    $c = rand(1, 9);
                    $d = $d . $c;
                    $b++;
                }
                return $d;
            }
            $todo_id = randomee(10);
            Cookie::queue('todo_id', $todo_id);
            return redirect()->route('index', $todo_id);
        } else {
            return redirect()->route('index', $user_id);
        }
    }

    public function index($user_id, Request $request)
    {
        if (Cookie::has('todo_id')) {
            $tasks = Task::where('user_id', $user_id)->orderBy("status", 'desc')->get();
            return view('todo', [
                'tasks' => $tasks,
                'user_id' => $user_id
            ]);
        } else
            return redirect()->route('index_2');
    }
    public function store($user_id, Request $request)
    {
        Task::where('user_id', $user_id)->create([
            'task' => $request->task,
            'user_id' => $user_id,
        ]);
        return back();
    }
    public function done($user_id, $id, Request $request)
    {
        $task = Task::where('id', $id)->first();
        if ($task->status == 1) {
            Task::where('user_id', $user_id)->where('id', $id)->update([
                'status' => 0,
            ]);
            return 0;
        }
        Task::where('user_id', $user_id)->where('id', $id)->update([
            'status' => 1,
        ]);
        return 1;
    }
    public function destroy($user_id, $id, Request $request)
    {
        Task::where('user_id', $user_id)->where('id', $id)->delete();
        $task = Task::where('user_id', $user_id)->get()->count();
        return $task;
    }
    public function destroyAll($user_id)
    {
        Task::where('user_id', $user_id)->truncate();
        return back();
    }
}