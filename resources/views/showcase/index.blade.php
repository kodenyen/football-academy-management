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
                    <a href="{{ route('about') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">About</a>
                    <a href="{{ route('gallery') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Gallery</a>
                    <a href="{{ route('showcase') }}" class="text-xs font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-2 rounded-full">Showcase</a>
                    <a href="{{ route('contact') }}" class="text-xs font-black text-slate-900 uppercase tracking-widest hover:text-primary transition">Contact</a>
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-8 text-xs">Join Us</a>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
                @forelse($players as $player)
                <div class="group bg-white border border-slate-100 rounded-[3rem] overflow-hidden hover:shadow-2xl transition-all duration-700">
                    <div class="aspect-[4/5] bg-slate-950 relative overflow-hidden">
                        @if($player->profile_photo)
                            <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-80 group-hover:opacity-100">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-800 text-8xl">
                                <i class="fa-solid fa-user-ninja"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 flex justify-between items-end">
                            <span class="bg-primary text-slate-950 px-5 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl">{{ $player->position }}</span>
                        </div>
                    </div>
                    <div class="p-10">
                        <div class="mb-8">
                            <h3 class="text-3xl font-black uppercase italic text-slate-900 tracking-tighter leading-none group-hover:text-primary transition-colors duration-300">{{ $player->user->name }}</h3>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-3">U{{ ceil($player->age / 2) * 2 }} Category / {{ $player->age }} YRS</p>
                        </div>
                        
                        <div class="space-y-6 mb-10">
                            @php $stats = $player->stats ?? ['speed' => 50, 'dribbling' => 50, 'shooting' => 50]; @endphp
                            @foreach($stats as $label => $val)
                            @if($loop->iteration <= 3)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-[9px] font-black uppercase text-slate-500 tracking-[0.2em]">{{ $label }}</span>
                                    <span class="text-[9px] font-black text-primary">{{ $val }}%</span>
                                </div>
                                <div class="w-full bg-slate-50 h-2 rounded-full overflow-hidden border border-slate-100">
                                    <div class="bg-primary h-full rounded-full transition-all duration-1000 group-hover:brightness-110" style="width: {{ $val }}%"></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        
                        <a href="{{ route('player.pdf', $player) }}" class="btn-primary w-full py-4 text-[10px] flex items-center justify-center space-x-3">
                            <i class="fa-solid fa-file-pdf text-base"></i>
                            <span>Download Full Report</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-48 text-center bg-slate-50 rounded-[4rem] border border-dashed border-slate-200">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
                        <i class="fa-solid fa-users text-4xl text-slate-200"></i>
                    </div>
                    <p class="uppercase font-black text-xs tracking-[0.3em] text-slate-400 italic leading-loose">The scout network is currently <br> gathering intelligence.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $players->links() }}
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
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.3em] mt-10">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </p>
        </div>
    </footer>
</body>
</html>
