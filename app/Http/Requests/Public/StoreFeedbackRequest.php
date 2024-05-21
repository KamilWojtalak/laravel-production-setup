<?php

namespace App\Http\Requests\Public;

use App\Mail\Feedback;
use App\Rules\Recaptcha;
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
            'content' => 'required|min:5',
            'g-recaptcha-response' => ['required' , new Recaptcha]
        ];
    }

    public function sendMail(): void
    {
        $content = $this->request->get('content');

        Mail::to('kontakt@wojtalak.com')->send(new Feedback($content));
    }
}
