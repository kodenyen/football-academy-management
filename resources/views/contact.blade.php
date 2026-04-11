<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - {{ $settings->academy_name }} - Elite Football Excellence</title>
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
                    <a href="{{ route('about') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">About Us</a>
                    <a href="{{ route('gallery') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Gallery</a>
                    <a href="{{ route('showcase') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Showcase</a>
                    <a href="{{ route('donate.index') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Support Us</a>
                    <a href="{{ route('contact') }}" class="text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-2 rounded-full">Contact</a>
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

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-b border-slate-200 overflow-hidden">
            <div class="px-4 pt-4 pb-12 space-y-3">
                <a href="/" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Home</a>
                <a href="{{ route('about') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">About Us</a>
                <a href="{{ route('gallery') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Gallery</a>
                <a href="{{ route('showcase') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Showcase</a>
                <a href="{{ route('contact') }}" class="block px-6 py-4 rounded-2xl text-lg font-black text-primary bg-primary/5 uppercase italic">Contact</a>
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
            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8">Communications Hub</span>
            <h1 class="text-5xl md:text-8xl font-black italic tracking-tighter uppercase text-white leading-none mb-10">
                Get In <span class="text-primary">Touch</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg font-medium leading-relaxed italic">Our elite team is ready to answer your questions about trials, programs, and recruitment.</p>
        </div>
    </header>

    <div class="py-32 bg-white relative -mt-16 z-20 rounded-t-[4rem] shadow-[0_-20px_60px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24">
                <!-- Info Section -->
                <div class="space-y-16">
                    <div class="prose prose-slate prose-xl text-slate-500 italic leading-relaxed font-medium">
                        <p>Whether you're an aspiring professional or a parent looking for the best training environment, we're here to guide you through the process.</p>
                    </div>

                    <div class="space-y-10">
                        <div class="group flex items-center space-x-8 bg-slate-50 p-10 rounded-[3rem] border border-slate-100 hover:border-primary/30 transition duration-500 hover:shadow-2xl">
                            <div class="w-20 h-20 bg-primary/10 text-primary rounded-2xl flex items-center justify-center text-4xl group-hover:bg-primary group-hover:text-slate-950 transition-all">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Tactical HQ</span>
                                <span class="font-black italic text-slate-900 text-2xl uppercase tracking-tighter leading-none">{{ $settings->address ?? 'Lagos, Nigeria' }}</span>
                            </div>
                        </div>

                        <div class="group flex items-center space-x-8 bg-slate-50 p-10 rounded-[3rem] border border-slate-100 hover:border-primary/30 transition duration-500 hover:shadow-2xl">
                            <div class="w-20 h-20 bg-slate-950 text-white rounded-2xl flex items-center justify-center text-4xl group-hover:bg-primary group-hover:text-slate-950 transition-all">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Direct Line</span>
                                <span class="font-black italic text-slate-900 text-2xl uppercase tracking-tighter leading-none">{{ $settings->phone_number ?? '+234...' }}</span>
                            </div>
                        </div>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '234') }}" target="_blank" 
                           class="group flex items-center justify-between bg-primary p-10 rounded-[3rem] border border-primary/20 shadow-2xl hover:brightness-110 transition duration-500">
                            <div class="flex items-center space-x-8">
                                <div class="w-20 h-20 bg-white/20 backdrop-blur-md text-slate-950 rounded-2xl flex items-center justify-center text-4xl">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-black text-slate-950/60 uppercase tracking-[0.3em] mb-2">Elite Chat</span>
                                    <span class="font-black italic text-slate-950 text-2xl uppercase tracking-tighter leading-none">Instant Message</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-arrow-right-long text-2xl text-slate-950/40 group-hover:translate-x-3 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="bg-white p-12 lg:p-16 rounded-[4rem] border border-slate-100 shadow-[0_40px_100px_rgba(0,0,0,0.08)]">
                    <form action="#" method="POST" class="space-y-10">
                        @csrf
                        <div class="grid grid-cols-1 gap-10">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4 ml-2">Identify Yourself</label>
                                <input type="text" name="name" placeholder="Full Name" required 
                                       class="w-full bg-slate-50 text-slate-900 rounded-[2rem] border-transparent focus:border-primary focus:ring-4 focus:ring-primary/10 p-6 font-black uppercase italic text-lg outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4 ml-2">Communication Channel</label>
                                <input type="email" name="email" placeholder="Email Address" required 
                                       class="w-full bg-slate-50 text-slate-900 rounded-[2rem] border-transparent focus:border-primary focus:ring-4 focus:ring-primary/10 p-6 font-black uppercase italic text-lg outline-none transition-all">
                            </div>
                        </div>
                        @php
                            $supportCampaign = null;
                            if(request('support')) {
                                $supportCampaign = \App\Models\FundingCampaign::find(request('support'));
                            }
                        @endphp
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4 ml-2">Strategic Inquiry</label>
                            <textarea name="message" rows="5" placeholder="How can our elite coaches assist you?" required 
                                      class="w-full bg-slate-50 text-slate-900 rounded-[2.5rem] border-transparent focus:border-primary focus:ring-4 focus:ring-primary/10 p-8 font-black uppercase italic text-lg outline-none transition-all resize-none">{{ $supportCampaign ? 'I would like to support the "' . $supportCampaign->title . '" fund. Please provide more details on how I can contribute.' : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full py-6 text-sm">Deploy Message</button>
                    </form>
                </div>
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
