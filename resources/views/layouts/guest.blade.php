<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TOPSIS') }}</title>
    <link rel="apple-touch-icon" sizes="1080x1080" href="{{ asset('img/logo.jpg') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Style -->
    <style>
        body {
           background: linear-gradient(to right, #ff416c, #ff4b2b);
        }

        .glass-card {
            backdrop-filter: blur(200px);
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        @media (max-width: 640px) {
        .glass-card {
        margin: 1rem auto;
        width: 100%;
        max-width: 90%;
        }
    }
    </style>
</head>
<body class="font-sans antialiased text-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('img/logo_telkom.jpg') }}" alt="Logo" class="w-20 h-20 ">
            </a>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 glass-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
