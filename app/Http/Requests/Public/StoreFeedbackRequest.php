<?php

namespace App\Http\Requests\Public;

use App\Mail\Feedback;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|min:5'
        ];
    }

    public function sendMail(): void
    {
        $content = $this->request->get('content');

        Mail::to('kontakt@wojtalak.com')->send(new Feedback($content));
    }
}
