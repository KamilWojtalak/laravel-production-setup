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
        /**
         * flash message trzeba dodać,
         *
         * zrób validation unhappy path
         *
         * TODO wysyłanie maili itp,
         * recaptcha
         */

        $content = $request->get('content');

        return redirect()->route('feedback.index')->with('success', __('Thank your for your feedback!'));
    }
}
