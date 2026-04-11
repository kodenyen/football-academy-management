<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - {{ $settings->academy_name }} - Elite Football Excellence</title>
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
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-white selection:bg-primary/30">
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
                
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Home</a>
                    <a href="{{ route('about') }}" class="text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-2 rounded-full">About Us</a>
                    <a href="{{ route('gallery') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Gallery</a>
                    <a href="{{ route('showcase') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Showcase</a>
                    <a href="{{ route('donate.index') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Support Us</a>
                    <a href="{{ route('contact') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Contact</a>
                </div>

                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary py-2.5 px-6 text-xs">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-xs font-black text-slate-900 uppercase tracking-[0.2em] hover:text-primary transition">Log in</a>
                        <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-8 text-xs">Join Us</a>
                    @endauth
                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-900 p-2 hover:bg-slate-100 rounded-xl transition">
                        <i class="fa-solid fa-bars-staggered text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-2xl" x-show="mobileMenuOpen"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative py-32 bg-slate-950 overflow-hidden">
        <div class="absolute inset-0 bg-primary/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8">Our Philosophy</span>
            <h1 class="text-5xl md:text-8xl font-black italic tracking-tighter uppercase text-white leading-none mb-10">
                Beyond the <span class="text-primary">Game</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg font-medium leading-relaxed italic">Developing athletes who dominate the field and lead with character off it.</p>
        </div>
    </header>

    <div class="py-32 bg-white relative -mt-16 z-20 rounded-t-[4rem] shadow-[0_-20px_60px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div>
                    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-10 italic text-slate-900 leading-none">
                        Our Elite <span class="text-primary">Heritage</span>
                    </h2>
                    <div class="prose prose-slate prose-xl text-slate-500 italic leading-relaxed font-medium mb-12">
                        {!! nl2br(e($settings->about_us_content ?: 'Empowering the next generation of football stars through professional coaching and disciplined training.')) !!}
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="group bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition duration-500 hover:shadow-2xl">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-slate-950 transition-colors">
                                <i class="fa-solid fa-eye text-xl"></i>
                            </div>
                            <span class="block text-2xl font-black text-slate-900 uppercase italic mb-4">Vision</span>
                            <p class="text-slate-500 text-sm leading-relaxed font-medium">{{ $settings->about_vision ?: 'To be the leading football academy recognized globally for developing elite talent.' }}</p>
                        </div>
                        <div class="group bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition duration-500 hover:shadow-2xl">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:bg-primary group-hover:text-slate-950 transition-colors">
                                <i class="fa-solid fa-rocket text-xl"></i>
                            </div>
                            <span class="block text-2xl font-black text-slate-900 uppercase italic mb-4">Mission</span>
                            <p class="text-slate-500 text-sm leading-relaxed font-medium">{{ $settings->about_mission ?: 'Providing world-class training facilities and professional coaching to unlock every player\'s full potential.' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="aspect-square bg-slate-950 rounded-[4rem] overflow-hidden border-[16px] border-slate-50 shadow-2xl relative">
                        <iframe class="absolute inset-0 w-full h-full transition duration-1000" 
                                src="https://www.youtube.com/embed/{{ $settings->about_video_id ?? 'dQw4w9WgXcQ' }}?autoplay=1&mute=1&loop=1&playlist={{ $settings->about_video_id ?? 'dQw4w9WgXcQ' }}&controls=0" 
                                frameborder="0" allow="autoplay; encrypted-media"></iframe>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                    </div>
                    <!-- Stats overlay -->
                    <div class="absolute -bottom-10 -left-10 bg-primary p-8 rounded-[2rem] shadow-2xl rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <span class="block text-4xl font-black text-slate-950 italic">100+</span>
                        <span class="text-[10px] font-black uppercase text-slate-950/60 tracking-widest">Active Talents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php $facilities = \App\Models\Facility::orderBy('order')->get(); @endphp
    @if($facilities->count() > 0)
    <!-- Facilities Section -->
    <section class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <span class="text-[10px] font-black uppercase text-primary tracking-[0.3em] mb-4 inline-block">Professional Environment</span>
                <h2 class="text-4xl md:text-7xl font-black uppercase tracking-tighter italic text-slate-900 leading-none">World-Class <span class="text-primary">Facilities</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($facilities as $facility)
                <div class="group bg-white rounded-[3rem] overflow-hidden border border-slate-100 hover:shadow-2xl transition duration-700">
                    <div class="h-80 bg-slate-950 overflow-hidden relative">
                        @if($facility->image)
                            <img src="{{ asset('storage/' . $facility->image) }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-1000 opacity-80">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-800 text-6xl font-black italic">TRFA</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                    </div>
                    <div class="p-12">
                        <h3 class="text-3xl font-black italic uppercase text-slate-900 tracking-tighter leading-none mb-6 group-hover:text-primary transition-colors">{{ $facility->name }}</h3>
                        <p class="text-slate-500 text-sm font-medium leading-relaxed italic">{{ $facility->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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
