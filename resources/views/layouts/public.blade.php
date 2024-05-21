<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? __('No title') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    @stack('head_scripts')
</head>

<body class="font-sans ">
    <x-public.flash></x-public.flash>

    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <x-public.navigation></x-public.navigation>

        {{ $slot }}
    </div>

    @stack('footer_scripts')
</body>

</html>
