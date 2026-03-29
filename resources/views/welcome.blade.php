<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->academy_name }} - Elite Football Excellence</title>
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
                
                <!-- Desktop Menu -->
                <div class="hidden lg:block">
                    <div class="ml-10 flex items-center space-x-1">
                        <a href="/" class="px-4 py-2 text-xs font-black text-primary uppercase tracking-widest bg-primary/10 rounded-full">Home</a>
                        <a href="{{ route('about') }}" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-primary transition uppercase tracking-widest">About</a>
                        <a href="{{ route('gallery') }}" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-primary transition uppercase tracking-widest">Gallery</a>
                        <a href="{{ route('showcase') }}" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-primary transition uppercase tracking-widest">Showcase</a>
                        <a href="{{ route('contact') }}" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-primary transition uppercase tracking-widest">Contact</a>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary py-2.5 px-6 text-xs">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-xs font-black text-slate-900 uppercase tracking-[0.2em] hover:text-primary transition">Log in</a>
                        <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-8 text-xs">Join Elite</a>
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
                <a href="/" class="block px-6 py-4 rounded-2xl text-lg font-black text-primary bg-primary/5 uppercase italic">Home</a>
                <a href="{{ route('about') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">About Us</a>
                <a href="{{ route('gallery') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Gallery</a>
                <a href="{{ route('showcase') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Showcase</a>
                <a href="{{ route('contact') }}" class="block px-6 py-4 rounded-2xl text-lg font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-tight transition">Contact</a>
                <div class="pt-6 border-t border-slate-100 flex flex-col space-y-4">
                    <a href="{{ route('login') }}" class="text-center font-black uppercase text-xs tracking-widest text-slate-900">Log In</a>
                    <a href="{{ route('register.trial') }}" class="btn-primary text-center">Join the Academy</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="relative h-[85vh] overflow-hidden bg-slate-950">
        @if($sliders->count() > 0)
            <div class="h-full w-full">
                @foreach($sliders as $index => $slider)
                <div class="absolute inset-0 transition-all duration-1000 {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-110' }}" id="slide-{{ $index }}">
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center p-6">
                        <div class="max-w-5xl">
                            <span class="inline-block px-4 py-1.5 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-8 animate-bounce">Elite Football Academy</span>
                            <h1 class="text-5xl sm:text-7xl md:text-9xl font-black italic tracking-tighter leading-[0.9] mb-8 uppercase text-white">
                                {!! str_replace(' ', '<br class="hidden md:block">', $slider->heading) !!}
                            </h1>
                            <p class="text-base sm:text-xl text-slate-300 mb-12 max-w-2xl mx-auto font-medium leading-relaxed">{{ $slider->sub_heading }}</p>
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                                <a href="{{ route('register.trial') }}" class="btn-primary px-12 py-5 text-sm w-full sm:w-auto">Book Your Trial Now</a>
                                <a href="{{ route('about') }}" class="px-12 py-5 border-2 border-white/20 hover:border-white/40 text-white rounded-2xl font-black uppercase tracking-widest transition backdrop-blur-sm text-sm w-full sm:w-auto">Learn More</a>
                            </div>
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
                        const oldSlide = document.getElementById('slide-' + currentSlide);
                        oldSlide.classList.replace('opacity-100', 'opacity-0');
                        oldSlide.classList.replace('scale-100', 'scale-110');
                        
                        currentSlide = (currentSlide + 1) % totalSlides;
                        
                        const newSlide = document.getElementById('slide-' + currentSlide);
                        newSlide.classList.replace('opacity-0', 'opacity-100');
                        newSlide.classList.replace('scale-110', 'scale-100');
                    }, 6000);
                }
            </script>
        @else
            <div class="h-full w-full flex items-center justify-center text-center">
                 <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-40">
                 <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                 <div class="relative z-10 p-6">
                    <h1 class="text-6xl md:text-[8rem] font-black italic tracking-tighter leading-none mb-10 text-white uppercase">Think Right<br><span class="text-primary">Football Academy</span></h1>
                    <a href="{{ route('register.trial') }}" class="btn-primary px-16 py-6 text-sm">Join the Next Generation</a>
                 </div>
            </div>
        @endif
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 hidden md:block">
            <div class="w-6 h-10 border-2 border-white/20 rounded-full flex justify-center p-1">
                <div class="w-1 h-2 bg-primary rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- Academy Programs -->
    <section class="py-32 bg-white relative -mt-24 z-20 rounded-t-[4rem] shadow-[0_-40px_80px_rgba(0,0,0,0.15)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-block px-4 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full mb-4">Training Excellence</div>
            <h2 class="text-4xl md:text-7xl font-black uppercase tracking-tighter mb-6 italic text-slate-900 leading-none">Our Elite <span class="text-primary">Programs</span></h2>
            <p class="text-slate-500 max-w-2xl mx-auto mb-20 font-medium">Professional training modules designed to transform raw talent into world-class football professionals.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($programs as $program)
                <div class="group relative bg-white rounded-[3rem] border border-slate-100 overflow-hidden hover:shadow-2xl transition-all duration-700">
                    <div class="h-80 bg-slate-950 overflow-hidden relative">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-80">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-800 text-6xl font-black italic uppercase">TRFA</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 text-left">
                             <h3 class="text-3xl font-black italic uppercase text-white tracking-tighter leading-none">{{ $program->name }}</h3>
                        </div>
                    </div>
                    <div class="p-10 text-left">
                        <p class="text-slate-500 text-sm mb-10 leading-relaxed font-medium line-clamp-3">{{ $program->description }}</p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('register.trial') }}" class="btn-primary py-3 px-8 text-[10px]">Enroll Now</a>
                            <div class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 group-hover:bg-primary transition-colors duration-500">
                                <i class="fa-solid fa-arrow-right text-xs group-hover:text-slate-900 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Matches -->
    @if($upcomingMatches->count() > 0)
    <section class="py-32 bg-slate-950 text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-[100px] -mr-48 -mt-48"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 space-y-6 md:space-y-0">
                <div class="text-left">
                    <h2 class="text-4xl md:text-6xl font-black italic uppercase tracking-tighter leading-none mb-4">Match <span class="text-primary">Fixtures</span></h2>
                    <p class="text-slate-400 font-medium">Catch the academy stars in action.</p>
                </div>
                <a href="{{ route('showcase') }}" class="text-xs font-black uppercase tracking-widest text-primary border-b-2 border-primary pb-1 hover:text-white hover:border-white transition">View All Matches</a>
            </div>
            
            <div class="grid grid-cols-1 gap-6">
                @foreach($upcomingMatches as $match)
                <div class="bg-slate-900/50 backdrop-blur-md border border-slate-800 p-10 rounded-[2.5rem] flex flex-col lg:flex-row items-center justify-between hover:border-primary/50 transition duration-500 group">
                    <div class="flex items-center space-x-8 md:space-x-16 mb-10 lg:mb-0">
                        <div class="text-center group-hover:scale-110 transition duration-500">
                            <div class="w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center mb-4 border border-slate-700">
                                <span class="text-3xl font-black italic text-primary">TR</span>
                            </div>
                            <span class="block text-xl font-black uppercase tracking-tighter">TRFA</span>
                        </div>
                        <div class="text-center">
                            <span class="text-4xl font-black text-primary italic">VS</span>
                            <span class="block text-[10px] text-slate-500 uppercase font-black tracking-widest mt-2">KICK OFF</span>
                        </div>
                        <div class="text-center group-hover:scale-110 transition duration-500">
                            <div class="w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center mb-4 border border-slate-700">
                                <span class="text-3xl font-black italic text-slate-400">{{ substr($match->opponent, 0, 1) }}</span>
                            </div>
                            <span class="block text-xl font-black uppercase tracking-tighter">{{ $match->opponent }}</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-10">
                        <div class="text-center md:text-right">
                            <span class="block font-black text-2xl uppercase tracking-tighter">{{ \Carbon\Carbon::parse($match->match_date)->format('d M') }}</span>
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">{{ $match->venue }}</span>
                        </div>
                        <div class="h-12 w-[1px] bg-slate-800 hidden md:block"></div>
                        <div class="text-center md:text-right">
                             <span class="block font-black text-xl uppercase tracking-tighter">{{ \Carbon\Carbon::parse($match->match_date)->format('H:i') }}</span>
                             <span class="text-[10px] text-primary font-black uppercase tracking-widest">GMT +1</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News -->
    @if($posts->count() > 0)
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-black mb-20 italic uppercase tracking-tighter text-slate-900">Latest <span class="text-primary">Intel</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach($posts as $post)
                <div class="group text-left">
                    <div class="aspect-[4/3] bg-slate-950 rounded-[2.5rem] overflow-hidden mb-8 relative">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 opacity-80">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-1.5 bg-primary text-slate-950 text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">{{ $post->category }}</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-black mb-4 group-hover:text-primary transition duration-300 italic uppercase text-slate-900 tracking-tighter leading-none">{{ $post->title }}</h3>
                    <p class="text-slate-500 text-sm mb-6 line-clamp-2 leading-relaxed font-medium">{{ Str::limit($post->content, 120) }}</p>
                    <a href="#" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-900 group-hover:text-primary transition-colors flex items-center">
                        Read Analysis <i class="fa-solid fa-arrow-right-long ml-3"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-slate-950 py-32 text-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-full h-1 bg-primary"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-20">
                <div class="lg:col-span-2">
                    <a href="/" class="flex items-center space-x-3 mb-10">
                        @if($settings->academy_logo)
                            <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-16 w-auto object-contain">
                        @else
                            <div class="bg-primary p-2 rounded-xl rotate-12">
                                <svg class="w-8 h-8 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        @endif
                        <span class="text-3xl font-black italic tracking-tighter uppercase">ThinkRight<span class="text-primary">FA</span></span>
                    </a>
                    <p class="text-slate-400 text-lg italic font-medium leading-relaxed max-w-lg mb-12">{{ $settings->about_us_content ?? 'Empowering the next generation of football stars through elite training and mentorship.' }}</p>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-slate-900 border border-slate-800 rounded-xl flex items-center justify-center hover:bg-primary hover:text-slate-950 transition-all duration-300"><i class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="w-12 h-12 bg-slate-900 border border-slate-800 rounded-xl flex items-center justify-center hover:bg-primary hover:text-slate-950 transition-all duration-300"><i class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#" class="w-12 h-12 bg-slate-900 border border-slate-800 rounded-xl flex items-center justify-center hover:bg-primary hover:text-slate-950 transition-all duration-300"><i class="fa-brands fa-x-twitter text-xl"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xs font-black mb-10 uppercase tracking-[0.3em] text-primary">Contact</h4>
                    <ul class="space-y-6 text-slate-400 text-sm font-medium">
                        <li class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-4 text-primary"></i>
                            <span>{{ $settings->address }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone mr-4 text-primary"></i>
                            <span>{{ $settings->phone_number }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-envelope mr-4 text-primary"></i>
                            <span>{{ $settings->email }}</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xs font-black mb-10 uppercase tracking-[0.3em] text-primary">Academy</h4>
                    <ul class="space-y-4 text-sm font-bold uppercase tracking-widest">
                        <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-primary transition">Philosophy</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-slate-400 hover:text-primary transition">Media Hub</a></li>
                        <li><a href="{{ route('showcase') }}" class="text-slate-400 hover:text-primary transition">Talent Showcase</a></li>
                        <li><a href="{{ route('register.trial') }}" class="text-slate-400 hover:text-primary transition">Join Elite</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-32 pt-12 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
                <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.3em]">
                    {{ $settings->footer_text ?? '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.' }}
                </p>
                <div class="flex space-x-8 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '234') }}" target="_blank" class="fixed bottom-10 right-10 z-[100] group">
        <div class="absolute inset-0 bg-primary rounded-[2rem] blur-xl opacity-40 group-hover:opacity-60 transition duration-500"></div>
        <div class="relative bg-primary text-slate-950 w-20 h-20 rounded-[2rem] flex items-center justify-center shadow-2xl group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500">
            <i class="fa-brands fa-whatsapp text-4xl"></i>
        </div>
    </a>
</body>
</html>
