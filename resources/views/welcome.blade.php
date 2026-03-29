<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color }};
            --secondary-color: {{ $settings->secondary_color }};
        }
        .bg-primary-custom { background-color: var(--primary-color); }
        .text-primary-custom { color: var(--primary-color); }
        .border-primary-custom { border-color: var(--primary-color); }
    </style>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    @if($settings->academy_logo)
                        <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-10 w-auto mr-2">
                    @endif
                    <span class="text-primary-custom font-bold text-xl tracking-tighter italic uppercase">{{ $settings->academy_name }}</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="px-3 py-2 rounded-md text-sm font-medium text-primary-custom border-b-2 border-primary-custom">Home</a>
                        <a href="#about" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-custom transition">About</a>
                        <a href="{{ route('gallery') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-custom transition">Gallery</a>
                        <a href="{{ route('showcase') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-custom transition">Talent Showcase</a>
                        <a href="#contact" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-custom transition">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Log in</a>
                        <a href="{{ route('register.trial') }}" class="bg-primary-custom text-black px-4 py-2 rounded-full text-sm font-bold hover:opacity-80 transition">Join Now</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="relative h-[65vh] overflow-hidden">
        @if($sliders->count() > 0)
            <div class="h-full w-full">
                @foreach($sliders as $index => $slider)
                <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" id="slide-{{ $index }}">
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover opacity-40 grayscale">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center p-4">
                        <div class="max-w-4xl">
                            <h1 class="text-5xl md:text-7xl font-extrabold italic tracking-tighter leading-none mb-6 uppercase">
                                {{ $slider->heading }}
                            </h1>
                            <p class="text-lg md:text-xl text-gray-300 mb-8">{{ $slider->sub_heading }}</p>
                            <a href="{{ route('register.trial') }}" class="bg-primary-custom text-black px-8 py-4 rounded-md text-lg font-black uppercase tracking-widest shadow-[0_0_20px_rgba(0,255,65,0.4)]">Book a Trial</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <script>
                let currentSlide = 0;
                const totalSlides = {{ $sliders->count() }};
                if(totalSlides > 1) {
                    setInterval(() => {
                        const activeSlide = document.getElementById('slide-' + currentSlide);
                        if(activeSlide) activeSlide.classList.replace('opacity-100', 'opacity-0');
                        currentSlide = (currentSlide + 1) % totalSlides;
                        const nextSlide = document.getElementById('slide-' + currentSlide);
                        if(nextSlide) nextSlide.classList.replace('opacity-0', 'opacity-100');
                    }, 5000);
                }
            </script>
        @else
            <!-- Placeholder Hero -->
            <div class="h-full w-full flex items-center justify-center text-center">
                 <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale">
                 <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                 <div class="relative z-10 p-4">
                    <h1 class="text-5xl md:text-7xl font-extrabold italic tracking-tighter leading-none mb-6">WELCOME TO <br><span class="text-primary-custom">{{ $settings->academy_name }}</span></h1>
                    <a href="{{ route('register.trial') }}" class="bg-primary-custom text-black px-8 py-4 rounded-md text-lg font-black uppercase tracking-widest">Book a Trial</a>
                 </div>
            </div>
        @endif
    </section>

    <!-- Academy Programs -->
    <section class="py-12 bg-zinc-900 relative -mt-16 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-4 italic">Our Academy <span class="text-primary-custom">Programs</span></h2>
            <div class="h-1 w-20 bg-primary-custom mx-auto mb-12"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                <div class="bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden hover:border-primary-custom/50 transition">
                    <div class="h-48 bg-zinc-800">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-700 text-4xl"><i class="fa-solid fa-futbol"></i></div>
                        @endif
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-black mb-4 italic uppercase">{{ $program->name }}</h3>
                        <p class="text-gray-400 text-sm mb-6">{{ $program->description }}</p>
                        <a href="{{ route('register.trial') }}" class="text-primary-custom text-xs font-black uppercase tracking-widest">Enroll Now →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="border-t border-zinc-800/50"></div>

    <!-- About Us Section -->
    <section id="about" class="py-20 bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-6 italic">About Our <span class="text-primary-custom">Academy</span></h2>
                    <div class="h-1 w-20 bg-primary-custom mb-8"></div>
                    <p class="text-gray-300 leading-relaxed text-lg italic">
                        {{ $settings->about_us_content ?: 'Empowering the next generation of football stars through professional coaching and disciplined training.' }}
                    </p>
                    <div class="mt-10 grid grid-cols-2 gap-6">
                        <div class="border-l-2 border-primary-custom pl-4">
                            <span class="block text-2xl font-black text-white">VISION</span>
                            <p class="text-xs text-gray-500 uppercase font-bold mt-1">Global Excellence</p>
                        </div>
                        <div class="border-l-2 border-primary-custom pl-4">
                            <span class="block text-2xl font-black text-white">MISSION</span>
                            <p class="text-xs text-gray-500 uppercase font-bold mt-1">Elite Development</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-video bg-zinc-800 rounded-2xl overflow-hidden border border-zinc-700">
                        <img src="https://images.unsplash.com/photo-1526232762683-217585e17a7a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" class="w-full h-full object-cover grayscale opacity-60">
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary-custom rounded-2xl flex items-center justify-center -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="border-t border-zinc-800/50"></div>

    <div class="border-t border-zinc-900/50"></div>

    <!-- Upcoming Matches Section (if any) -->
    @if($upcomingMatches->count() > 0)
    <section class="py-20 bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black mb-8 italic uppercase tracking-tighter">Upcoming <span class="text-primary-custom">Fixtures</span></h2>
            <div class="space-y-4">
                @foreach($upcomingMatches as $match)
                <div class="bg-zinc-900/50 border border-zinc-800 p-6 rounded-xl flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-6 mb-4 md:mb-0">
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter">TRFA</span>
                            <span class="text-[10px] text-gray-500 uppercase font-bold">Home Team</span>
                        </div>
                        <span class="text-2xl font-black text-primary-custom italic italic">VS</span>
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter">{{ $match->opponent }}</span>
                            <span class="text-[10px] text-gray-500 uppercase font-bold">Away Team</span>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <span class="block font-bold text-gray-300">{{ \Carbon\Carbon::parse($match->match_date)->format('d M, Y | H:i') }}</span>
                        <span class="text-sm text-gray-500">{{ $match->venue }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="border-t border-zinc-900/50"></div>
    @endif

    <!-- News / Blog Section -->
    @if($posts->count() > 0)
    <section class="py-20 bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black mb-8 italic uppercase tracking-tighter">Latest <span class="text-primary-custom">News</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden group">
                    <div class="h-40 bg-zinc-800">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] font-bold text-primary-custom uppercase tracking-widest">{{ $post->category }}</span>
                        <h3 class="text-xl font-black mt-2 mb-4 group-hover:text-primary-custom transition italic uppercase">{{ $post->title }}</h3>
                        <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit($post->content, 100) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="border-t border-zinc-900/50"></div>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-12 italic text-center">Contact <span class="text-primary-custom">Us</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-zinc-800 p-8 rounded-2xl border border-zinc-700">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Name</label>
                            <input type="text" name="name" required class="w-full bg-white text-black rounded-lg border-zinc-300 focus:ring-primary-custom px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full bg-white text-black rounded-lg border-zinc-300 focus:ring-primary-custom px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Message</label>
                            <textarea name="message" rows="4" required class="w-full bg-white text-black rounded-lg border-zinc-300 focus:ring-primary-custom px-4 py-3"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary-custom text-black py-4 rounded-xl font-black uppercase tracking-widest hover:opacity-80 transition">Send Message</button>
                    </form>
                </div>

                <!-- Info & Map -->
                <div class="space-y-8">
                    <div class="bg-zinc-800 p-8 rounded-2xl border border-zinc-700 h-full">
                        <h3 class="text-xl font-black uppercase italic mb-6">Find Us Here</h3>
                        <div class="space-y-6 text-gray-300">
                            <div class="flex items-start">
                                <i class="fa-solid fa-location-dot mt-1 text-primary-custom mr-4"></i>
                                <div>
                                    <span class="block font-bold text-white uppercase text-xs">Address</span>
                                    <p class="text-sm italic">{{ $settings->address ?? 'Lagos, Nigeria' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fa-solid fa-phone mt-1 text-primary-custom mr-4"></i>
                                <div>
                                    <span class="block font-bold text-white uppercase text-xs">Phone</span>
                                    <p class="text-sm">{{ $settings->phone_number ?? '+234...' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fa-solid fa-envelope mt-1 text-primary-custom mr-4"></i>
                                <div>
                                    <span class="block font-bold text-white uppercase text-xs">Email</span>
                                    <p class="text-sm">{{ $settings->email ?? 'info@academy.com' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Simple Map Placeholder -->
                        <div class="mt-8 aspect-video bg-zinc-900 rounded-xl overflow-hidden border border-zinc-700 flex items-center justify-center grayscale opacity-50">
                             <i class="fa-solid fa-map-location-dot text-4xl text-zinc-700"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-zinc-900 py-16 border-t border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div>
                    <span class="text-primary-custom font-bold text-2xl italic tracking-tighter">{{ $settings->academy_name }}</span>
                    <p class="mt-4 text-gray-500 text-sm italic">{{ $settings->about_us_content ?? 'Empowering the next generation of football stars.' }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 italic uppercase">Contact Details</h4>
                    <p class="text-gray-500 text-sm space-y-2">
                        <span class="block"><i class="fa-solid fa-location-dot mr-2"></i> {{ $settings->address ?? 'Lagos, Nigeria' }}</span>
                        <span class="block"><i class="fa-solid fa-phone mr-2"></i> {{ $settings->phone_number ?? '+234...' }}</span>
                        <span class="block"><i class="fa-solid fa-envelope mr-2"></i> {{ $settings->email ?? 'info@academy.com' }}</span>
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6 italic uppercase">Support</h4>
                    <p class="text-gray-500 text-sm">{{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? $settings->phone_number ?? '2340000000000') }}" target="_blank" class="fixed bottom-6 right-6 z-[100] bg-green-500 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.5)] hover:scale-110 transition">
        <i class="fa-brands fa-whatsapp text-white text-3xl"></i>
    </a>
</body>
</html>
