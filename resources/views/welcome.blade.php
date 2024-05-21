<x-public-layout>
    <x-slot name="title">
        Strona główna title
    </x-slot>

    <section class="title-section">
        <p>{{ __('Powered by Stripe') }}</p>
        <h1>{{ __('Tutaj jest miejsce na tytuł, który zwróci uwagę klienta i wywoła w nim emocje.') }}
        </h1>
        <p class="py-5">
            {{ __('Focus on your startup, not the invoices Let your customers generate, edit, and download Stripe invoices, so you don’t have to.') }}
        </p>
        <ul class="py-5">
            <li>1-minute no-code setup</li>
            <li>Reduce customer support</li>
            <li>No 0.4% Stripe invoice fee</li>
        </ul>
        <a href="/pricing" class="dashboard-cta">Get My Product</a>
    </section>

    <section class="dashboard-section flex">
        <div class="container">
            <div class="box box-container flex flex-row items-center justify-center">
                <div class="box red-box mx-6">
                    <h2>Tytuł twojego błędu</h2>
                    <ul>
                        <li>Pierwszy twój problem, który rozwiążę</li>
                        <li>Drugi twój problem, który rozwiążę</li>
                        <li>Trzeci twój problem, który rozwiążę</li>
                        <li>Czwarty twój problem, który rozwiążę</li>
                    </ul>
                </div>
                <div class="box green-box mx-6">
                    <h2>Tytuł twojego rozwiązania</h2>
                    <ul>
                        <li>Tu jest moje pierwsze rozwiązanie</li>
                        <li>Tu jest moje drugie rozwiązanie</li>
                        <li>Tu jest moje trzecie rozwiązanie</li>
                        <li>Tu jest moje czwarte rozwiązanie</li>
                    </ul>
                </div>
            </div>
        </div>

    </section>

    <div class="dashboard-section dashboard-pricing flex flex-row items-center justify-between">
        <div class="container flex flex-row items-center justify-center">
            <div class="pricing-box pricing-left mr-10">
                <div class="price flex items-center">
                    <p class="old pr-2"><s>$99</s></p>
                    <p class="new pr-1">$49</p>
                    <p class="currency">USD</p>
                </div>
                <ul>
                    <li>Korzyść 1</li>
                    <li>Korzyść 2</li>
                    <li>Korzyść 3</li>
                </ul>
                <a href="/pricing" class="dashboard-cta">Get My Product</a>
                <p class="side-note">One-time payment, <u>then it's yours forever</u></p>
            </div>
            <div class="pricing-box pricing-right">
                <div class="price flex items-center">
                    <p class="old pr-2"><s>$119</s></p>
                    <p class="new pr-1">$69</p>
                    <p class="currency">USD</p>
                </div>
                <ul>
                    <li>Korzyść 1</li>
                    <li>Korzyść 2</li>
                    <li>Korzyść 3 więszka</li>
                </ul>
                <a href="/pricing" class="dashboard-cta">Get My Product</a>
                <p class="side-note">One-time payment, <u>then it's yours forever</u></p>
            </div>
        </div>
    </div>

</x-public-layout>
