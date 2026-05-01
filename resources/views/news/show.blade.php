<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - {{ $settings->academy_name }}</title>
    
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
        .prose img { border-radius: 2rem; }
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-slate-50 selection:bg-primary/30">
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
                    <a href="{{ route('showcase') }}" class="px-4 py-2 text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-primary transition whitespace-nowrap">Showcase</a>
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
                <a href="{{ route('showcase') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Showcase</a>
                <a href="{{ route('donate.index') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Support Us</a>
                <a href="{{ route('contact') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Contact</a>
                <div class="pt-6 border-t border-slate-100 flex flex-col space-y-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-center font-black uppercase text-xs tracking-widest text-primary">Dashboard</a>
                    @endauth
                    <a href="{{ route('login') }}" class="text-center font-black uppercase text-xs tracking-widest text-slate-900">Log In</a>
                    <a href="{{ route('register.trial') }}" class="btn-primary text-center">Join the Academy</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Post Header -->
    <header class="bg-white border-b border-slate-200 pt-16 pb-32 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 -skew-x-12 translate-x-1/4"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8">{{ $post->category }}</span>
            <h1 class="text-4xl md:text-7xl font-black italic tracking-tighter uppercase text-slate-900 leading-[0.9] mb-8">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center space-x-6 text-[10px] font-black uppercase tracking-widest text-slate-400">
                <span class="flex items-center"><i class="fa-solid fa-calendar-day mr-2 text-primary"></i> {{ $post->created_at->format('d M, Y') }}</span>
                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                <span class="flex items-center"><i class="fa-solid fa-user mr-2 text-primary"></i> BY {{ $post->user->name ?? 'ADMIN' }}</span>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-32">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Content -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-[3rem] p-8 md:p-16 shadow-2xl border border-slate-100 overflow-hidden">
                    @if($post->featured_image)
                    <div class="aspect-video rounded-[2.5rem] overflow-hidden mb-12 shadow-xl">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <div class="prose prose-slate prose-lg max-w-none prose-headings:italic prose-headings:uppercase prose-headings:tracking-tighter prose-headings:font-black prose-p:italic prose-p:font-medium prose-p:text-slate-500">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <div class="mt-12 flex items-center justify-between px-10">
                    <a href="/" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-primary transition-colors flex items-center">
                        <i class="fa-solid fa-arrow-left-long mr-3"></i> Back to Intelligence
                    </a>
                    <div class="flex items-center space-x-4">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Share:</span>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-primary hover:text-slate-900 transition-all"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3 space-y-12">
                <!-- Recent Intel -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="text-xl font-black italic uppercase tracking-tighter text-slate-900 mb-8 pb-4 border-b border-slate-50">Recent <span class="text-primary">Intel</span></h3>
                    <div class="space-y-8">
                        @foreach($recentPosts as $recent)
                        <a href="{{ route('news.show', $recent->slug) }}" class="group flex items-start space-x-4">
                            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden">
                                @if($recent->featured_image)
                                    <img src="{{ asset('storage/' . $recent->featured_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-black uppercase italic text-slate-900 group-hover:text-primary transition-colors line-clamp-2 leading-tight tracking-tighter">{{ $recent->title }}</h4>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-2 block">{{ $recent->created_at->format('d M, Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-slate-950 rounded-[3.5rem] p-10 relative overflow-hidden text-center group">
                    <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-[0.03] transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <span class="text-[9px] font-black uppercase text-primary tracking-[0.3em] mb-4 inline-block">Elite Pathway</span>
                        <h3 class="text-2xl font-black italic text-white uppercase tracking-tighter leading-none mb-6">Ready to Join the <span class="text-primary">Ranks?</span></h3>
                        <p class="text-slate-400 text-sm italic font-medium mb-10">Book your evaluation session today and start your journey.</p>
                        <a href="{{ route('register.trial') }}" class="btn-primary w-full py-4 text-[10px]">Secure Your Trial</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 py-32 text-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <a href="/" class="inline-flex items-center space-x-3 mb-10">
                @if($settings->academy_logo)
                    <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-16 w-auto object-contain">
                @endif
                <span class="text-3xl font-black italic tracking-tighter uppercase text-white">ThinkRight<span class="text-primary">FA</span></span>
            </a>
            <div class="mt-8 flex flex-wrap justify-center gap-8 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="{{ route('about') }}" class="hover:text-primary transition">Philosophy</a>
                <a href="{{ route('gallery') }}" class="hover:text-primary transition">Media Hub</a>
                <a href="{{ route('showcase') }}" class="hover:text-primary transition">Showcase</a>
                <a href="{{ route('donate.index') }}" class="hover:text-primary transition">Support Fund</a>
                <a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a>
            </div>
            <p class="mt-12 text-[10px] font-black uppercase tracking-[0.3em] text-slate-600">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </p>
        </div>
    </footer>
</body>
</html>
