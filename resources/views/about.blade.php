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
                    <div class="aspect-video sm:aspect-square bg-zinc-800 rounded-3xl overflow-hidden border border-zinc-700 shadow-2xl relative">
                        <!-- Reliable YouTube Loop -->
                        <iframe class="absolute inset-0 w-full h-full grayscale opacity-60" 
                                src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1&playlist=dQw4w9WgXcQ&controls=0" 
                                frameborder="0" allow="autoplay; encrypted-media"></iframe>
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary-custom rounded-3xl -z-10 opacity-20 blur-2xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilities Section -->
    <section class="py-20 bg-zinc-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter italic">World-Class <span class="text-primary-custom">Facilities</span></h2>
                <div class="h-1 w-20 bg-primary-custom mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-700 hover:border-primary-custom transition duration-500">
                    <img src="https://images.unsplash.com/photo-1556056504-5c7696c4c28d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="h-64 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                    <div class="p-6">
                        <h3 class="text-xl font-black uppercase italic text-white">Main Training Pitch</h3>
                        <p class="text-gray-500 text-sm mt-2 font-medium italic">Professional-grade hybrid grass pitch designed for elite performance.</p>
                    </div>
                </div>
                <div class="group bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-700 hover:border-primary-custom transition duration-500">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="h-64 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                    <div class="p-6">
                        <h3 class="text-xl font-black uppercase italic text-white">Elite Fitness Gym</h3>
                        <p class="text-gray-500 text-sm mt-2 font-medium italic">Fully equipped modern gym for strength and conditioning.</p>
                    </div>
                </div>
                <div class="group bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-700 hover:border-primary-custom transition duration-500">
                    <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="h-64 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                    <div class="p-6">
                        <h3 class="text-xl font-black uppercase italic text-white">Recovery Center</h3>
                        <p class="text-gray-500 text-sm mt-2 font-medium italic">Specialized area for physio and player recovery.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Showcase Section -->
    <section class="py-20 bg-zinc-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter italic">Experience <span class="text-primary-custom">The Action</span></h2>
                <p class="text-gray-500 text-sm mt-2 uppercase font-bold tracking-widest">Watch our training sessions in action</p>
            </div>
            
            <div class="aspect-video bg-zinc-800 rounded-[2rem] overflow-hidden border border-zinc-700 shadow-2xl relative group">
                <!-- Using a standard YouTube Embed for reliability -->
                <iframe class="w-full h-full grayscale hover:grayscale-0 transition duration-700" 
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                        title="Academy Video" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-zinc-900 py-16 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
            <p class="text-gray-500 text-xs">{{ $settings->footer_text }}</p>
        </div>
    </footer>
</body>
</html>
