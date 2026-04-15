<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - {{ $settings->academy_name }} - Elite Football Excellence</title>

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
        body { font-family: var(--body-font); }
        h1, h2, h3, h4, h5, h6, .heading-elite { font-family: var(--heading-font); }

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
                
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="/" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Home</a>
                    <a href="{{ route('about') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">About Us</a>
                    <a href="{{ route('gallery') }}" class="text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-2 rounded-full whitespace-nowrap">Gallery</a>
                    <a href="{{ route('showcase') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Showcase</a>
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
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-b border-slate-200 overflow-hidden">
            <div class="px-4 pt-4 pb-12 space-y-3">
                <a href="/" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Home</a>
                <a href="{{ route('about') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">About Us</a>
                <a href="{{ route('gallery') }}" class="block px-6 py-4 rounded-2xl text-lg font-black text-primary bg-primary/5 uppercase italic">Gallery</a>
                <a href="{{ route('showcase') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Showcase</a>
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
            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8">Visual History</span>
            <h1 class="{{ $settings->hero_heading_size ?? 'text-5xl md:text-8xl' }} font-black italic tracking-tighter uppercase text-white leading-none mb-10">
                Media <span class="text-primary">Hub</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg font-medium leading-relaxed italic">Capturing the intensity, discipline, and glory of our elite athletes.</p>
        </div>
    </header>

    <div class="py-32 bg-white relative -mt-16 z-20 rounded-t-[4rem] shadow-[0_-20px_60px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
                @forelse($items as $item)
                <div class="group relative aspect-[4/5] bg-slate-950 rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition duration-700">
                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-80 group-hover:opacity-100">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition p-10 flex flex-col justify-end">
                        <div class="translate-y-4 group-hover:translate-y-0 transition duration-500">
                            <span class="block text-[10px] font-black text-primary uppercase tracking-[0.2em] mb-2 opacity-0 group-hover:opacity-100 transition duration-500">Moment {{ $loop->iteration }}</span>
                            <span class="text-xl font-black text-white italic uppercase tracking-tighter leading-none">{{ $item->title ?? 'TRFA Action' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-48 text-center bg-slate-50 rounded-[4rem] border border-dashed border-slate-200">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
                        <i class="fa-solid fa-camera text-4xl text-slate-200"></i>
                    </div>
                    <p class="uppercase font-black text-xs tracking-[0.3em] text-slate-400 italic leading-loose">The digital vault is currently <br> being synchronized.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $items->links() }}
            </div>
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
