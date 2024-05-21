<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\StoreFeedbackRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index');
    }

    public function store(StoreFeedbackRequest $request)
    {
        $request->sendMail();

        return redirect()->route('feedback.index')->with('success', __('Thank your for your feedback!'));
    }
}
