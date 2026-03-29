<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color }};
            --bg-color: {{ $settings->background_color ?? '#18181b' }};
        }
        .bg-primary-custom { background-color: var(--primary-color); }
        .text-primary-custom { color: var(--primary-color); }
        .border-primary-custom { border-color: var(--primary-color); }
        body { background-color: var(--bg-color); }
    </style>
</head>
<body class="text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <a href="/" class="text-primary-custom font-bold text-xl italic tracking-tighter uppercase">{{ $settings->academy_name }}</a>
            <a href="/" class="text-sm font-medium hover:text-primary-custom transition underline">Back to Home</a>
        </div>
    </nav>

    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-6 italic">About Our <span class="text-primary-custom">Academy</span></h1>
                    <div class="h-1 w-20 bg-primary-custom mb-10"></div>
                    <div class="prose prose-invert prose-lg text-gray-300 italic leading-relaxed">
                        {!! nl2br(e($settings->about_us_content ?: 'Empowering the next generation of football stars through professional coaching and disciplined training.')) !!}
                    </div>
                    
                    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="bg-zinc-800 p-6 rounded-2xl border-l-4 border-primary-custom">
                            <span class="block text-xl font-black text-white uppercase italic">Our Vision</span>
                            <p class="text-gray-400 text-sm mt-2">To be the leading football academy recognized globally for developing elite talent and well-rounded individuals.</p>
                        </div>
                        <div class="bg-zinc-800 p-6 rounded-2xl border-l-4 border-primary-custom">
                            <span class="block text-xl font-black text-white uppercase italic">Our Mission</span>
                            <p class="text-gray-400 text-sm mt-2">Providing world-class training facilities and professional coaching to unlock every player's full potential.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1526232762683-217585e17a7a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" class="rounded-3xl shadow-2xl grayscale opacity-60 border border-zinc-700">
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-primary-custom rounded-3xl -z-10 opacity-20"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-zinc-900 py-16 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
            <p class="text-gray-500 text-xs">{{ $settings->footer_text }}</p>
        </div>
    </footer>
</body>
</html>
