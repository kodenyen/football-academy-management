<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @php
            $siteSettings = \App\Models\SiteSetting::first();
            $primaryColor = $siteSettings->primary_color ?? '#00FF41';
            $secondaryColor = $siteSettings->secondary_color ?? '#0f172a';
            $headingFont = $siteSettings->heading_font ?? 'Inter';
            $bodyFont = $siteSettings->body_font ?? 'Inter';
        @endphp

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family={{ str_replace(' ', '+', $headingFont) }}:wght@400;700;800&family={{ str_replace(' ', '+', $bodyFont) }}:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(err => {
                    console.error('Error in copying text: ', err);
                });
            }
        </script>
    </head>
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --heading-font: '{{ $headingFont }}', sans-serif;
            --body-font: '{{ $bodyFont }}', sans-serif;
        }
        body { background-color: #f1f5f9; color: #0f172a; font-family: var(--body-font); }
        h1, h2, h3, h4, h5, h6 { font-family: var(--heading-font); }
        
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .border-primary { border-color: var(--primary-color) !important; }
    </style>
    <body class="font-sans antialiased text-slate-900 selection:bg-primary/30">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 border-b border-slate-200 shadow-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-1.5 bg-primary rounded-full"></div>
                            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight uppercase">
                                {{ $header }}
                            </h2>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
