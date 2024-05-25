<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        return view('dashboard.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('dashboard.tasks.create');
    }

    // NOTE Without clean code
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Task::create([
            'name' => $request->get('name'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('dashboard.tasks.index')->with('success', 'utworzono task');
    }

    public function destroy(string $id)
    {
        //
    }
}
