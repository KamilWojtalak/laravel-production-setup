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
        return view('dashboard.test-access-first-plan');
    }

    public function testAccessSecondPlan()
    {
        return view('dashboard.test-access-second-plan');
    }
}
