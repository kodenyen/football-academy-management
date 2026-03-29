<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
            --secondary-color: {{ $settings->secondary_color ?? '#000000' }};
        }
        .bg-primary-custom { background-color: var(--primary-color); }
        .text-primary-custom { color: var(--primary-color); }
        .border-primary-custom { border-color: var(--primary-color); }
        body { background-color: #ffffff; color: #0f172a; }
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-white">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    @if($settings->academy_logo)
                        <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-10 w-auto mr-3">
                    @endif
                    <span class="text-slate-900 font-black text-xl md:text-2xl tracking-tighter italic uppercase">
                        THINK<span class="text-green-600">RIGHT</span>
                    </span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="/" class="px-3 py-2 text-sm font-black text-green-600 border-b-2 border-green-600 uppercase tracking-widest">Home</a>
                        <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-bold text-slate-600 hover:text-green-600 transition uppercase tracking-widest">About</a>
                        <a href="{{ route('gallery') }}" class="px-3 py-2 text-sm font-bold text-slate-600 hover:text-green-600 transition uppercase tracking-widest">Gallery</a>
                        <a href="{{ route('showcase') }}" class="px-3 py-2 text-sm font-bold text-slate-600 hover:text-green-600 transition uppercase tracking-widest">Showcase</a>
                        <a href="{{ route('contact') }}" class="px-3 py-2 text-sm font-bold text-slate-600 hover:text-green-600 transition uppercase tracking-widest">Contact</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden sm:block text-sm font-black text-slate-900 uppercase tracking-widest hover:text-green-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-bold text-slate-600 hover:text-green-600 transition uppercase tracking-widest">Log in</a>
                        <a href="{{ route('register.trial') }}" class="bg-green-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-green-700 transition shadow-lg shadow-green-600/20">Join</a>
                    @endauth
                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-900 p-2">
                        <i class="fa-solid fa-bars-staggered text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden bg-white border-b border-slate-200">
            <div class="px-4 pt-4 pb-8 space-y-2">
                <a href="/" class="block px-4 py-4 rounded-2xl text-lg font-black text-green-600 bg-green-50 uppercase italic">Home</a>
                <a href="{{ route('about') }}" class="block px-4 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase">About Us</a>
                <a href="{{ route('gallery') }}" class="block px-4 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase">Gallery</a>
                <a href="{{ route('showcase') }}" class="block px-4 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase">Showcase</a>
                <a href="{{ route('contact') }}" class="block px-4 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="relative h-[65vh] overflow-hidden bg-slate-900">
        @if($sliders->count() > 0)
            <div class="h-full w-full">
                @foreach($sliders as $index => $slider)
                <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" id="slide-{{ $index }}">
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover opacity-50">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center p-6">
                        <div class="max-w-4xl">
                            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black italic tracking-tighter leading-tight mb-4 uppercase text-white">
                                {{ $slider->heading }}
                            </h1>
                            <p class="text-sm sm:text-lg text-slate-200 mb-8 max-w-lg mx-auto font-medium">{{ $slider->sub_heading }}</p>
                            <a href="{{ route('register.trial') }}" class="inline-block bg-green-500 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-2xl">Book Trial</a>
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
                        document.getElementById('slide-' + currentSlide).classList.replace('opacity-100', 'opacity-0');
                        currentSlide = (currentSlide + 1) % totalSlides;
                        document.getElementById('slide-' + currentSlide).classList.replace('opacity-0', 'opacity-100');
                    }, 5000);
                }
            </script>
        @else
            <div class="h-full w-full flex items-center justify-center text-center">
                 <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-40">
                 <div class="relative z-10 p-4">
                    <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter leading-none mb-6 text-white uppercase">THINK<span class="text-green-500">RIGHT</span> ACADEMY</h1>
                    <a href="{{ route('register.trial') }}" class="bg-green-500 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-2xl">Book a Trial</a>
                 </div>
            </div>
        @endif
    </section>

    <!-- Academy Programs -->
    <section class="py-24 bg-white relative -mt-16 z-20 rounded-t-[3rem] shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-4 italic text-slate-900">Academy <span class="text-green-600">Programs</span></h2>
            <div class="h-1.5 w-20 bg-green-500 mx-auto mb-16 rounded-full"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($programs as $program)
                <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="h-64 bg-slate-100 overflow-hidden">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 text-6xl font-black italic uppercase">TRFA</div>
                        @endif
                    </div>
                    <div class="p-10 text-left">
                        <h3 class="text-2xl font-black mb-3 italic uppercase text-slate-900 tracking-tighter">{{ $program->name }}</h3>
                        <p class="text-slate-500 text-sm mb-8 leading-relaxed font-medium">{{ $program->description }}</p>
                        <a href="{{ route('register.trial') }}" class="inline-block bg-slate-900 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-green-600 transition">Enroll Now</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Matches -->
    @if($upcomingMatches->count() > 0)
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black mb-12 italic uppercase tracking-tighter text-slate-900 text-center">Upcoming <span class="text-green-600">Fixtures</span></h2>
            <div class="space-y-6">
                @foreach($upcomingMatches as $match)
                <div class="bg-white shadow-sm border border-slate-100 p-8 rounded-3xl flex flex-col md:flex-row items-center justify-between hover:shadow-md transition">
                    <div class="flex items-center space-x-10 mb-6 md:mb-0">
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter text-slate-900">TRFA</span>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">HOME</span>
                        </div>
                        <span class="text-3xl font-black text-green-600 italic">VS</span>
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter text-slate-900">{{ $match->opponent }}</span>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">AWAY</span>
                        </div>
                    </div>
                    <div class="text-center md:text-right bg-slate-50 px-6 py-3 rounded-2xl border border-slate-100">
                        <span class="block font-black text-slate-900 text-sm uppercase tracking-widest">{{ \Carbon\Carbon::parse($match->match_date)->format('d M, Y') }}</span>
                        <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $match->venue }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News -->
    @if($posts->count() > 0)
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black mb-12 italic uppercase tracking-tighter text-slate-900 text-center">Latest <span class="text-green-600">News</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($posts as $post)
                <div class="group">
                    <div class="aspect-video bg-slate-100 rounded-3xl overflow-hidden mb-6">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @endif
                    </div>
                    <span class="text-[10px] font-black text-green-600 uppercase tracking-widest">{{ $post->category }}</span>
                    <h3 class="text-xl font-black mt-2 mb-4 group-hover:text-green-600 transition italic uppercase text-slate-900">{{ $post->title }}</h3>
                    <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed font-medium">{{ Str::limit($post->content, 100) }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-slate-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 text-center md:text-left">
                <div>
                    <span class="text-white font-black text-2xl italic tracking-tighter">THINK<span class="text-green-500">RIGHT</span></span>
                    <p class="mt-6 text-slate-400 text-sm italic font-medium leading-relaxed max-w-xs">{{ $settings->about_us_content ?? 'Empowering the next generation of football stars.' }}</p>
                </div>
                <div>
                    <h4 class="text-xs font-black mb-8 uppercase tracking-[0.2em] text-green-500">Contact Details</h4>
                    <p class="text-slate-300 text-sm space-y-4">
                        <span class="block"><i class="fa-solid fa-location-dot mr-3 text-green-500"></i> {{ $settings->address }}</span>
                        <span class="block"><i class="fa-solid fa-phone mr-3 text-green-500"></i> {{ $settings->phone_number }}</span>
                        <span class="block"><i class="fa-solid fa-envelope mr-3 text-green-500"></i> {{ $settings->email }}</span>
                    </p>
                </div>
                <div>
                    <h4 class="text-xs font-black mb-8 uppercase tracking-[0.2em] text-green-500">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-slate-400 font-bold uppercase tracking-widest">
                        <li><a href="{{ route('about') }}" class="hover:text-green-500 transition">About Us</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-green-500 transition">Gallery</a></li>
                        <li><a href="{{ route('register.trial') }}" class="hover:text-green-500 transition">Join Academy</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-20 pt-8 border-t border-slate-800 text-center text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </div>
        </div>
    </footer>

    <!-- WhatsApp -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '234') }}" target="_blank" class="fixed bottom-8 right-8 z-[100] bg-green-500 text-white w-16 h-16 rounded-3xl flex items-center justify-center shadow-2xl hover:scale-110 transition shadow-green-500/40">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
    </a>
</body>
</html>
