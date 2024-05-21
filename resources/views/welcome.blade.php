<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TEST TITLE</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans ">
    <div class="">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <section class="dashboard-section main-dashboard-section relative">
                <div class="container">
                    <div class="flex items-center justify-between">
                        <menu>
                            <nav>
                                <ul class="flex items-center justify-center">
                                    <li class="px-5 flex flex-row items-center justify-center">
                                        <a href="#">Navigation</a>
                                    </li>
                                    <li class="px-5">
                                        <a href="#">Navigation</a>
                                    </li>
                                </ul>
                            </nav>
                        </menu>
                        <header class="">
                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </header>
                    </div>

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
                </div>

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
                <div class="container">
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
                        <p>One-time payment, <u>then it's your forever</u></p>
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
                        <p>One-time payment, <u>then it's your forever</u></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
