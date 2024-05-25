<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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

    // NOTE Without validation on purpose
    public function store(Request $request): Redirector|RedirectResponse
    {
        try {
            return $this->handleStore($request);
        } catch (AuthorizationException $e) {
            return redirect()
                ->route('dashboard.tasks.index')
                ->with('error', 'Niestety możesz stworzyć tylko jeden task, żeby móc stworzyć więcej tasków musisz kupić lepszy pakiet.');
        }
    }

    // NOTE no validation - only test purposes
    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }

    private function handleStore(Request $request): Redirector|RedirectResponse
    {
        $this->authorize('tasks.store');

        Task::create([
            'name' => $request->input('name'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('dashboard.tasks.index')->with('success', 'Utworzono task.');
    }
}
