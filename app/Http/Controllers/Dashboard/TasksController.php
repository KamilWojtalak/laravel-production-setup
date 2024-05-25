<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// NOTE no validation, and no authorization, only test purposes
class TasksController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tasks = Task::query()
            ->currentUser()
            ->get();

        return view('dashboard.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('dashboard.tasks.create');
    }

    // NOTE Without clean code
    public function store(Request $request)
    {
        if (auth()->user()->can('tasks.store'))
        {
            dd('może');
        }
        else
        {
            dd('nie może');
        }

        Task::create([
            'name' => $request->get('name'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('dashboard.tasks.index')->with('success', 'utworzono task');
    }

    // NOTE no validation - only test purposes
    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
