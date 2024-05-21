<x-public-layout>
    <x-slot name="header">
        {{ __('Feedback') }}
    </x-slot>

    <section class="public-section">
        <div class="container">
            <div class="title-container mb-10">
                <h1>{{ __('Send me your feedback!') }}</h1>
            </div>
            <form action="{{ route('feedback.store') }}" method="post" class="feedback-form mb-20">
                @csrf
                <textarea name="content" id="" cols="30" rows="10"
                    placeholder="{{ __('If you want me to reply you back, include your email inside the content.') }}"></textarea>
                <button>Submit</button>
            </form>
        </div>
    </section>

</x-public-layout>
