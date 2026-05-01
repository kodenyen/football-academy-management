<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        @php
            $settings = \App\Models\SiteSetting::first();
        @endphp
        
        <style>
            :root {
                --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
            }
            body { font-family: 'Inter', sans-serif; }
            .bg-primary { background-color: var(--primary-color); }
            .text-primary { color: var(--primary-color); }
            .border-primary { border-color: var(--primary-color); }
            .focus\:ring-primary:focus { --tw-ring-color: var(--primary-color); }
            .focus\:border-primary:focus { border-color: var(--primary-color); }
        </style>
    </head>
    <body class="text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 w-1/2 h-full bg-primary opacity-[0.03] -skew-x-12 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-slate-900 opacity-[0.02] skew-x-12 -translate-x-1/4"></div>

            <div class="relative z-10 w-full flex flex-col items-center">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
