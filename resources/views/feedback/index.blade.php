@push('head_scripts')
    @reCaptchaHead()
@endpush

@push('footer_scripts')
    @reCaptchaFooter('demo-form')
@endpush

<x-public-layout>
    <x-slot name="header">
        {{ __('Feedback') }}
    </x-slot>

    <section class="public-section">
        <div class="container">
            <div class="title-container mb-10">
                <h1>{{ __('Send me your feedback!') }}</h1>
            </div>
            <form action="{{ route('feedback.store') }}" method="post" class="feedback-form mb-20" id="demo-form">
                @csrf

                <x-forms.textarea name="content"
                    placeholder="{{ __('If you want me to reply you back, include your email inside the input.') }}"></x-forms.textarea>

                <button class="g-recaptcha" data-sitekey="{{ config('recaptcha.api_site_key') }}"
                    data-callback="onSubmitRecaptcha" data-action="submit">
                    {{ __('Submit') }}
                </button>

            </form>
        </div>
    </section>

</x-public-layout>
