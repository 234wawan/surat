<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Surat PDAM') }}</title>

        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230369a1'/%3E%3Cpath d='M32 12 Q18 30 18 40 Q18 52 32 52 Q46 52 46 40 Q46 30 32 12Z' fill='%237dd3fc' stroke='%23ffffff' stroke-width='1.5'/%3E%3Cpath d='M32 18 Q24 30 24 40 Q24 48 32 48' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' opacity='0.5'/%3E%3C/svg%3E">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
            style="background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 30%, #0ea5e9 70%, #7dd3fc 100%);">
            <!-- Water wave pattern overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: url(\"data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 50 Q25 35 50 50 T100 50' fill='none' stroke='%23ffffff' stroke-width='2'/%3E%3Cpath d='M0 70 Q25 55 50 70 T100 70' fill='none' stroke='%23ffffff' stroke-width='1.5'/%3E%3Cpath d='M0 90 Q25 75 50 90 T100 90' fill='none' stroke='%23ffffff' stroke-width='1'/%3E%3C/svg%3E\");
                background-size: 200px 100px;">
            </div>
            <!-- Floating bubbles -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -bottom-10 left-1/4 w-20 h-20 bg-white/10 rounded-full blur-sm"></div>
                <div class="absolute -bottom-10 left-3/4 w-32 h-32 bg-white/10 rounded-full blur-sm"></div>
                <div class="absolute top-1/4 left-1/5 w-16 h-16 bg-white/10 rounded-full blur-sm"></div>
                <div class="absolute top-1/3 right-1/6 w-24 h-24 bg-white/10 rounded-full blur-sm"></div>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-lg relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
