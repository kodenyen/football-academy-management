<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talent Showcase - {{ $settings->academy_name }} - Elite Football Excellence</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
            --secondary-color: {{ $settings->secondary_color ?? '#0f172a' }};
        }
        .text-primary { color: var(--primary-color); }
        .bg-primary { background-color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-white selection:bg-primary/30" x-data="{ activeVideo: null }">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="group flex items-center space-x-3">
                        @if($settings->academy_logo)
                            <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-12 md:h-16 w-auto object-contain">
                        @else
                            <div class="bg-primary p-2 rounded-xl transform group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-8 h-8 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        @endif
                        <span class="text-2xl font-black italic tracking-tighter uppercase text-slate-900">
                            ThinkRight<span class="text-primary">FA</span>
                        </span>
                    </a>
                </div>
                
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="/" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Home</a>
                    <a href="{{ route('about') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">About Us</a>
                    <a href="{{ route('gallery') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Gallery</a>
                    <a href="{{ route('showcase') }}" class="text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-2 rounded-full whitespace-nowrap">Showcase</a>
                    <a href="{{ route('donate.index') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Support Us</a>
                    <a href="{{ route('contact') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary py-2.5 px-6 text-xs whitespace-nowrap">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-xs font-black text-slate-900 uppercase tracking-[0.2em] hover:text-primary transition whitespace-nowrap">Log in</a>
                        <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-6 text-xs whitespace-nowrap">Join Us</a>
                    @endauth
                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-900 p-2 hover:bg-slate-100 rounded-xl transition">
                        <i class="fa-solid fa-bars-staggered text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-b border-slate-200 overflow-hidden">
            <div class="px-4 pt-4 pb-12 space-y-3">
                <a href="/" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Home</a>
                <a href="{{ route('about') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">About Us</a>
                <a href="{{ route('gallery') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Gallery</a>
                <a href="{{ route('showcase') }}" class="block px-6 py-4 rounded-2xl text-lg font-black text-primary bg-primary/5 uppercase italic">Showcase</a>
                <a href="{{ route('donate.index') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Support Us</a>
                <a href="{{ route('contact') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Contact</a>
                <div class="pt-6 border-t border-slate-100 flex flex-col space-y-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary text-center">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-center font-black uppercase text-xs tracking-widest text-slate-900">Log In</a>
                        <a href="{{ route('register.trial') }}" class="btn-primary text-center">Join the Academy</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative py-32 bg-slate-950 overflow-hidden text-center">
        <div class="absolute inset-0 bg-primary/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8">Scouting Network</span>
            <h1 class="text-5xl md:text-8xl font-black italic tracking-tighter uppercase text-white leading-none mb-10">
                Talent <span class="text-primary">Showcase</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg font-medium leading-relaxed italic">The digital frontier for the world's next football icons.</p>
        </div>
    </header>

    <div class="py-32 bg-white relative -mt-16 z-20 rounded-t-[4rem] shadow-[0_-20px_60px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($videos as $video)
                <div class="group bg-slate-950 rounded-[3rem] overflow-hidden border border-slate-800 shadow-2xl transition-all duration-700 hover:border-primary/30">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video relative overflow-hidden cursor-pointer" @click="activeVideo = @js($video)">
                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/maxresdefault.jpg" 
                             onerror="this.src='https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg'"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-60 group-hover:opacity-100">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center transform group-hover:scale-125 transition duration-500 shadow-2xl">
                                <i class="fa-solid fa-play text-slate-950 text-2xl ml-1"></i>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                    </div>

                    <!-- Video Info -->
                    <div class="p-10">
                        <div class="mb-8">
                            <h3 class="text-3xl font-black uppercase italic text-white tracking-tighter leading-none group-hover:text-primary transition-colors duration-300">{{ $video->title }}</h3>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-3">
                                @if($video->player)
                                    U{{ ceil($video->player->age / 2) * 2 }} Division &bull; {{ $video->player->position }}
                                @else
                                    {{ $video->position ?? 'Academy Feature' }}
                                @endif
                            </p>
                        </div>
                        
                        @if($video->player)
                        <div class="space-y-6 mb-10">
                            @php $stats = $video->player->stats ?? ['speed' => 50, 'dribbling' => 50, 'shooting' => 50]; @endphp
                            @foreach($stats as $label => $val)
                            @if($loop->iteration <= 2)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-[9px] font-black uppercase text-slate-500 tracking-[0.2em]">{{ $label }}</span>
                                    <span class="text-[9px] font-black text-primary">{{ $val }}%</span>
                                </div>
                                <div class="w-full bg-slate-800 h-1 rounded-full overflow-hidden border border-slate-700">
                                    <div class="bg-primary h-full rounded-full transition-all duration-1000 group-hover:brightness-110" style="width: {{ $val }}%"></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        
                        <a href="{{ route('player.pdf', $video->player) }}" class="btn-primary w-full py-4 text-[10px] flex items-center justify-center space-x-3">
                            <i class="fa-solid fa-file-pdf text-base"></i>
                            <span>Download Full Report</span>
                        </a>
                        @else
                        <a href="{{ route('contact') }}" class="btn-primary w-full py-4 text-[10px] flex items-center justify-center space-x-3">
                            <i class="fa-solid fa-envelope text-base"></i>
                            <span>Inquire About Talent</span>
                        </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-48 text-center bg-slate-50 rounded-[4rem] border border-dashed border-slate-200">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
                        <i class="fa-solid fa-clapperboard text-4xl text-slate-200"></i>
                    </div>
                    <p class="uppercase font-black text-xs tracking-[0.3em] text-slate-400 italic leading-loose">The digital showcase is currently <br> being curated for prime time.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div x-show="activeVideo" x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-12 bg-slate-950/95 backdrop-blur-2xl"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        
        <div class="relative w-full max-w-6xl aspect-video bg-black rounded-[2.5rem] overflow-hidden shadow-[0_0_100px_rgba(0,255,65,0.2)] border border-white/10" @click.away="activeVideo = null">
            <template x-if="activeVideo">
                <iframe class="w-full h-full" 
                        :src="'https://www.youtube.com/embed/' + activeVideo.video_id + '?autoplay=1'" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            </template>
            
            <button @click="activeVideo = null" class="absolute top-8 right-8 w-12 h-12 bg-white/10 hover:bg-primary hover:text-slate-950 rounded-full flex items-center justify-center transition-all duration-300 text-white group">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
    </div>

    <footer class="bg-slate-950 py-32 text-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="/" class="inline-flex items-center space-x-3 mb-10">
                @if($settings->academy_logo)
                    <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-16 w-auto object-contain">
                @else
                    <div class="bg-primary p-2 rounded-xl rotate-12">
                        <svg class="w-8 h-8 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                @endif
                <span class="text-3xl font-black italic tracking-tighter uppercase text-white">ThinkRight<span class="text-primary">FA</span></span>
            </a>
            <div class="mt-10 flex flex-wrap justify-center gap-8 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="{{ route('about') }}" class="text-slate-400 hover:text-primary transition">Philosophy</a>
                <a href="{{ route('gallery') }}" class="text-slate-400 hover:text-primary transition">Media Hub</a>
                <a href="{{ route('showcase') }}" class="text-slate-400 hover:text-primary transition">Talent Showcase</a>
                <a href="{{ route('donate.index') }}" class="text-slate-400 hover:text-primary transition">Support Fund</a>
                <a href="{{ route('register.trial') }}" class="text-slate-400 hover:text-primary transition">Join Us</a>
            </div>
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.3em] mt-10">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </p>
        </div>
    </footer>
</body>
</html>
