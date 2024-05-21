<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Nie nadałeś title' }}</title>

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
                    <x-public.navigation></x-public.navigation>
                </div>

            </section>

            {{ $slot }}

        </div>
</body>

</html>
