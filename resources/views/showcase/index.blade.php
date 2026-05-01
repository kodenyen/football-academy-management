<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talent Showcase - {{ $settings->academy_name ?? 'Academy' }}</title>

    <!-- Dynamic Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ str_replace(' ', '+', $settings->heading_font ?? 'Inter') }}:wght@400;700;900&family={{ str_replace(' ', '+', $settings->body_font ?? 'Inter') }}:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
            --secondary-color: {{ $settings->secondary_color ?? '#0f172a' }};
            --heading-font: '{{ $settings->heading_font ?? 'Inter' }}', sans-serif;
            --body-font: '{{ $settings->body_font ?? 'Inter' }}', sans-serif;
        }
        body { font-family: var(--body-font); background-color: #f8fafc; }
        h1, h2, h3, h4, h5, h6, .heading-elite { font-family: var(--heading-font); }

        .text-primary { color: var(--primary-color); }
        .bg-primary { background-color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-slate-50 selection:bg-primary/30" x-data="{ activeVideo: null }">
    
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="group flex items-center space-x-3">
                        @if($settings->academy_logo)
                            <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-12 md:h-16 w-auto object-contain">
                        @else
                            <div class="bg-primary p-2 rounded-xl">
                                <i class="fa-solid fa-bolt text-slate-900"></i>
                            </div>
                        @endif
                        <span class="text-2xl font-black italic tracking-tighter uppercase text-slate-900">
                            ThinkRight<span class="text-primary">FA</span>
                        </span>
                    </a>
                </div>
                
                <div class="hidden lg:flex items-center space-x-2">
                    <a href="/" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Home</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">About Us</a>
                    <a href="{{ route('gallery') }}" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Gallery</a>
                    <a href="{{ route('showcase') }}" class="px-6 py-2 text-[10px] font-black text-primary uppercase tracking-widest bg-primary/10 rounded-full whitespace-nowrap">Showcase</a>
                    <a href="{{ route('donate.index') }}" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Support</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden sm:block text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-[10px] font-black text-slate-900 uppercase tracking-widest hover:text-primary">Log in</a>
                        <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-6 text-[10px]">Join Us</a>
                    @endauth
                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-900 p-2 hover:bg-slate-100 rounded-xl transition">
                        <i class="fa-solid fa-bars-staggered text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="bg-white border-b border-slate-200 py-20 overflow-hidden relative min-h-[500px] flex items-center">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 -skew-x-12 translate-x-1/4"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="max-w-2xl lg:w-1/2">
                    <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-6">Talent Hub</span>
                    <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter uppercase text-slate-900 leading-none mb-6">
                        Elite <span class="text-primary">Showcase</span>
                    </h1>
                    <p class="text-slate-500 text-lg font-medium italic max-w-xl">Discover the future of professional football. Our top-tier talent highlight reels and performance reports.</p>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <div class="relative w-full aspect-square max-w-md mx-auto">
                        <!-- Decorative Elements -->
                        <div class="absolute -inset-4 bg-primary/10 rounded-[3rem] rotate-6"></div>
                        <div class="absolute -inset-4 border-2 border-slate-100 rounded-[3rem] -rotate-3"></div>
                        
                        <!-- Main Hero Image -->
                        <div class="relative h-full w-full bg-slate-200 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="{{ $settings->showcase_hero ? asset('storage/' . $settings->showcase_hero) : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800' }}" 
                                 class="w-full h-full object-cover"
                                 alt="Showcase Hero">
                            
                            <!-- Floating Badge -->
                            <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-white/50 animate-bounce">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-slate-900">
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase text-slate-400 leading-none">Elite Status</p>
                                        <p class="text-xs font-black text-slate-900 uppercase">Verified Talent</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($videos as $video)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-500">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video relative overflow-hidden cursor-pointer bg-slate-900" @click="activeVideo = @js($video)">
                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/hqdefault.jpg" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-90 group-hover:opacity-100"
                             alt="{{ $video->title }}">
                        
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30 transform group-hover:scale-110 group-hover:bg-primary transition duration-500">
                                <i class="fa-solid fa-play text-white group-hover:text-slate-900 text-xl ml-1 transition"></i>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-4 right-4 px-3 py-1 bg-black/60 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-widest">
                            <i class="fa-brands fa-youtube mr-1 text-red-500"></i> YouTube
                        </div>
                    </div>

                    <!-- Video Info -->
                    <div class="p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-black uppercase italic text-slate-900 tracking-tighter leading-tight group-hover:text-primary transition-colors">{{ $video->title }}</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-1 h-1 rounded-full bg-primary"></div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    {{ $video->position ?? 'Academy Feature' }}
                                </p>
                            </div>
                        </div>
                        
                        @if($video->player)
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center overflow-hidden">
                                        @if($video->player->profile_photo)
                                            <img src="{{ asset('storage/' . $video->player->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-user text-slate-300"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase text-slate-900">{{ $video->player->user->name ?? 'Student' }}</p>
                                        <p class="text-[9px] font-bold text-slate-400">U{{ ceil($video->player->age / 2) * 2 }} Division</p>
                                    </div>
                                </div>
                                <a href="{{ route('player.pdf', $video->player) }}" class="text-[9px] font-black uppercase text-primary hover:underline">Full Report</a>
                            </div>
                        @endif

                        <button @click="activeVideo = @js($video)" class="w-full py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-slate-900 transition-all duration-300 shadow-xl shadow-slate-900/10 hover:shadow-primary/20">
                            Watch Highlights
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-slate-200 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-clapperboard text-3xl text-slate-200"></i>
                    </div>
                    <h4 class="text-xl font-black uppercase italic text-slate-900 mb-2">Coming Soon</h4>
                    <p class="text-slate-400 text-sm font-medium italic">We are currently curating the next generation of football icons.</p>
                </div>
                @endforelse
            </div>

        </div>
    </main>

    <!-- Video Modal -->
    <div x-show="activeVideo" x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-12 bg-slate-900/95 backdrop-blur-xl"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="relative w-full max-w-5xl aspect-video bg-black rounded-[2rem] overflow-hidden shadow-2xl" @click.away="activeVideo = null">
            <template x-if="activeVideo">
                <iframe class="w-full h-full" 
                        :src="'https://www.youtube.com/embed/' + (activeVideo.video_id || '') + '?autoplay=1'" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            </template>
            
            <button @click="activeVideo = null" class="absolute top-6 right-6 w-10 h-10 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-full flex items-center justify-center transition-all duration-300">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
    </div>

    <footer class="bg-slate-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="/" class="inline-flex items-center space-x-3 mb-10">
                <span class="text-2xl font-black italic tracking-tighter uppercase text-white">ThinkRight<span class="text-primary">FA</span></span>
            </a>
            <div class="mt-8 flex flex-wrap justify-center gap-6 text-[9px] font-black uppercase tracking-widest text-slate-500">
                <a href="{{ route('about') }}" class="hover:text-primary transition">Philosophy</a>
                <a href="{{ route('gallery') }}" class="hover:text-primary transition">Media Hub</a>
                <a href="{{ route('showcase') }}" class="hover:text-primary transition text-white">Showcase</a>
                <a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a>
            </div>
            <p class="mt-10 text-[9px] font-black uppercase tracking-widest text-slate-600">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </p>
        </div>
    </footer>

</body>
</html>
