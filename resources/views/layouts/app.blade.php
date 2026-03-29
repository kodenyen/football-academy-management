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
    @php
        $siteSettings = \App\Models\SiteSetting::first();
        $bgColor = $siteSettings->background_color ?? '#18181b';
        $primaryColor = $siteSettings->primary_color ?? '#00FF41';
    @endphp
    <style>
        :root {
            --bg-color: {{ $bgColor }};
            --primary-color: {{ $primaryColor }};
        }
        body { background-color: var(--bg-color) !important; }
        .bg-zinc-900 { background-color: var(--bg-color) !important; }
        .bg-zinc-950 { background-color: var(--bg-color) !important; }
    </style>
    <body class="font-sans antialiased text-white">
        <div class="min-h-screen" style="background-color: var(--bg-color);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-zinc-900 border-b border-zinc-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
