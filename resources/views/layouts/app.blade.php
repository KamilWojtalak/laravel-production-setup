<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @if (session('error'))
            <p style="color: red">{{ session('error') }}</p>
        @endif

        @if (session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif

        @if (Auth::user()->doShowPlanPaymentRemainder())
            <div class="">
                payment remainder <a href="{{ route('stripe.index') }}">Link do płatności</a>
            </div>
        @endif

        @if (Auth::user()->hasNotPayedForPlanSinceMonth())
            <div class="">
                oplac usługi bo wygasł ci pakiet <a href="{{ route('stripe.index') }}">Link do płatności</a>
            </div>
        @endif

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
