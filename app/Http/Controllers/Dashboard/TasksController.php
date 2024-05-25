<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return view('dashboard.tasks.index');
    }

    public function create()
    {
        return view('dashboard.tasks.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function destroy(string $id)
    {
        //
    }
}
