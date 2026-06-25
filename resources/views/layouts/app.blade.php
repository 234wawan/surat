<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Informasi Surat') }}</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230369a1'/%3E%3Cpath d='M32 12 Q18 30 18 40 Q18 52 32 52 Q46 52 46 40 Q46 30 32 12Z' fill='%237dd3fc' stroke='%23ffffff' stroke-width='1.5'/%3E%3Cpath d='M32 18 Q24 30 24 40 Q24 48 32 48' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' opacity='0.5'/%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.topbar')

            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50 dark:bg-gray-900">
                @if (session('success'))
                    <div class="mb-6 px-5 py-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-xl flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @isset($header)
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $header }}</h1>
                    </div>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar')?.classList.toggle('-translate-x-full');
        });
        document.getElementById('sidebarClose')?.addEventListener('click', function() {
            document.getElementById('sidebar')?.classList.add('-translate-x-full');
        });

        document.getElementById('notifButton')?.addEventListener('click', function(e) {
            e.stopPropagation();
            const dd = document.getElementById('notifDropdown');
            dd?.classList.toggle('hidden');
        });
        document.addEventListener('click', function() {
            document.getElementById('notifDropdown')?.classList.add('hidden');
        });
        document.getElementById('notifDropdown')?.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
    @stack('scripts')
</body>
</html>
