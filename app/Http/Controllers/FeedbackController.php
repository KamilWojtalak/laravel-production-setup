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
         * flash message trzeba dodać
         *
         * TODO wysyłanie maili itp,
         * recaptcha
         */


        dd($request->validated());

        return redirect()->to('feedback.index')->with('success', __('Thank your for your feedback!'));
    }
}
