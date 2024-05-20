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
        <div
            class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>
                <menu>
                    <nav>
                        <ul>
                            <li>
                                <a href="#">Navigation</a>
                            </li>
                            <li>
                                <a href="#">Navigation</a>
                            </li>
                        </ul>
                    </nav>
                </menu>
            </div>
            <section class="title-section">
                <h1>{{ __('Tutaj jest miejsce na tytuł, który zwróci uwagę klienta i wywoła w nim emocje.') }}</h1>
            </section>
            <section>
                Tutaj dajesz styling z red box i green box
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
            </section>
        </div>
    </div>
</body>

</html>
