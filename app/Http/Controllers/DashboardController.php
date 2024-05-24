<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function testAccessFirstPlan()
    {
        $this->authorize('first-plan');

        return view('dashboard.test-access-first-plan');
    }

    public function testAccessSecondPlan()
    {
        $this->authorize('first-plan');

        return view('dashboard.test-access-second-plan');
    }
}
