<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media Gallery - {{ $settings->academy_name ?? 'Academy' }}</title>

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
<body class="text-slate-900 font-sans antialiased bg-slate-50 selection:bg-primary/30" x-data="{ activeImage: null }">
    
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
                    <a href="{{ route('gallery') }}" class="px-6 py-2 text-[10px] font-black text-primary uppercase tracking-widest bg-primary/10 rounded-full whitespace-nowrap">Gallery</a>
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
    </nav>

    <!-- Header Section -->
    <section class="bg-white border-b border-slate-200 py-20 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50 -skew-x-12 translate-x-1/4"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-6">Visual History</span>
                <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter uppercase text-slate-900 leading-none mb-6">
                    Media <span class="text-primary">Vault</span>
                </h1>
                <p class="text-slate-500 text-lg font-medium italic max-w-xl">Capturing the intensity, discipline, and glory of our elite athletes through the lens.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($items as $item)
                <div class="group relative aspect-[4/5] bg-white rounded-[2rem] overflow-hidden border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-700 cursor-pointer"
                     @click="activeImage = @js($item)">
                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-90 group-hover:opacity-100">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 p-8 flex flex-col justify-end">
                        <span class="text-xl font-black text-white italic uppercase tracking-tighter leading-none translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            {{ $item->title ?? 'TRFA Moment' }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-slate-200 shadow-sm">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-camera text-3xl text-slate-200"></i>
                    </div>
                    <h4 class="text-xl font-black uppercase italic text-slate-900 mb-2">Empty Vault</h4>
                    <p class="text-slate-400 text-sm font-medium italic">We are currently synchronizing our media hub.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $items->links() }}
            </div>
        </div>
    </main>

    <!-- Lightbox Modal -->
    <div x-show="activeImage" x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-12 bg-slate-900/95 backdrop-blur-xl"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="relative w-full max-w-5xl max-h-full flex flex-col items-center" @click.away="activeImage = null">
            <div class="relative w-full rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/10">
                <template x-if="activeImage">
                    <img :src="'/storage/' + activeImage.file_path" 
                         class="w-full h-auto max-h-[80vh] object-contain bg-black/40">
                </template>
                
                <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 to-transparent">
                    <h3 x-text="activeImage?.title || 'TRFA Moment'" class="text-2xl font-black text-white italic uppercase tracking-tighter"></h3>
                </div>
            </div>
            
            <button @click="activeImage = null" class="mt-8 w-12 h-12 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-full flex items-center justify-center transition-all duration-300">
                <i class="fa-solid fa-xmark text-xl"></i>
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
                <a href="{{ route('gallery') }}" class="hover:text-primary transition text-white">Media Hub</a>
                <a href="{{ route('showcase') }}" class="hover:text-primary transition">Showcase</a>
                <a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a>
            </div>
            <p class="mt-10 text-[9px] font-black uppercase tracking-widest text-slate-600">
                {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
            </p>
        </div>
    </footer>

</body>
</html>
