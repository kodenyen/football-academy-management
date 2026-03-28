<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>THINK RIGHT FOOTBALL ACADEMY</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-green-custom { background-color: #00FF41; }
        .text-green-custom { color: #00FF41; }
        .border-green-custom { border-color: #00FF41; }
    </style>
</head>
<body class="bg-black text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-black/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-green-custom font-bold text-xl tracking-tighter italic">THINK RIGHT</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-green-custom border-b-2 border-green-custom">Home</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-custom transition">About</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-custom transition">Programs</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-custom transition">Gallery</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:text-green-custom transition">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Log in</a>
                        <a href="{{ route('register') }}" class="bg-green-custom text-black px-4 py-2 rounded-full text-sm font-bold hover:bg-green-400 transition">Join Now</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-[80vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Football Background" class="w-full h-full object-cover opacity-40 scale-110 grayscale">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl md:text-7xl font-extrabold italic tracking-tighter leading-none mb-6">
                <span class="block text-white">THINK RIGHT.</span>
                <span class="block text-green-custom">PLAY SMART.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8 leading-relaxed">
                Elevating the next generation of football stars. Professional coaching, modern facilities, and a pathway to greatness.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register.trial') }}" class="bg-green-custom text-black text-center px-8 py-4 rounded-md text-lg font-black hover:bg-green-400 transition shadow-[0_0_20px_rgba(0,255,65,0.4)] uppercase tracking-widest">
                    Book a Trial
                </a>
                <a href="#" class="bg-transparent border-2 border-white text-white text-center px-8 py-4 rounded-md text-lg font-bold hover:bg-white hover:text-black transition uppercase tracking-widest">
                    Our Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-zinc-900 border-y border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <span class="block text-4xl font-black text-green-custom">500+</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500 font-bold">Graduated Players</span>
                </div>
                <div>
                    <span class="block text-4xl font-black text-green-custom">15+</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500 font-bold">Expert Coaches</span>
                </div>
                <div>
                    <span class="block text-4xl font-black text-green-custom">4</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500 font-bold">Age Categories</span>
                </div>
                <div>
                    <span class="block text-4xl font-black text-green-custom">10</span>
                    <span class="text-xs uppercase tracking-widest text-gray-500 font-bold">Championships Won</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Preview -->
    <section class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter mb-4 italic italic">Our Academy <span class="text-green-custom">Programs</span></h2>
            <div class="h-1 w-20 bg-green-custom mx-auto mb-10"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach(['U10', 'U13', 'U15', 'U17'] as $cat)
                <div class="group relative overflow-hidden bg-zinc-900 rounded-2xl border border-zinc-800 hover:border-green-custom/50 transition duration-500">
                    <div class="p-8">
                        <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500 border border-zinc-800 group-hover:border-green-custom">
                             <i class="fa-solid fa-trophy text-green-custom text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-black mb-2">{{ $cat }} Category</h3>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">Foundational training focused on ball control and spatial awareness.</p>
                        <a href="#" class="inline-block text-green-custom text-xs font-black uppercase tracking-widest group-hover:underline transition">View Details →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Matches -->
    @if($upcomingMatches->count() > 0)
    <section class="py-20 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black mb-8 italic">Upcoming <span class="text-green-custom">Fixtures</span></h2>
            <div class="space-y-4">
                @foreach($upcomingMatches as $match)
                <div class="bg-black border border-zinc-800 p-6 rounded-xl flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-6 mb-4 md:mb-0">
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter">TRFA</span>
                            <span class="text-[10px] text-gray-500 uppercase font-bold">Home Team</span>
                        </div>
                        <span class="text-2xl font-black text-green-custom italic italic">VS</span>
                        <div class="text-center">
                            <span class="block text-2xl font-black uppercase tracking-tighter">{{ $match->opponent }}</span>
                            <span class="text-[10px] text-gray-500 uppercase font-bold">Away Team</span>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <span class="block font-bold text-gray-300">{{ \Carbon\Carbon::parse($match->match_date)->format('d M, Y | H:i') }}</span>
                        <span class="text-sm text-gray-500">{{ $match->venue }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 relative overflow-hidden bg-green-custom">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-4xl md:text-6xl font-black text-black italic tracking-tighter mb-8 leading-none">JOIN THE BEST <br>ACADEMY IN TOWN!</h2>
            <a href="{{ route('register.trial') }}" class="inline-block bg-black text-green-custom px-12 py-5 rounded-full text-xl font-black hover:scale-105 transition shadow-2xl uppercase tracking-tighter">
                Register as a Player
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-16 border-t border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <span class="text-green-custom font-bold text-2xl italic tracking-tighter">THINK RIGHT</span>
                    <p class="mt-4 text-gray-500 max-w-xs text-sm leading-relaxed">Empowering young athletes to achieve their dreams on and off the field. Excellence is not an act, but a habit.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-green-custom transition">About Us</a></li>
                        <li><a href="#" class="hover:text-green-custom transition">Training Programs</a></li>
                        <li><a href="#" class="hover:text-green-custom transition">Match Results</a></li>
                        <li><a href="#" class="hover:text-green-custom transition">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-zinc-900 rounded-full flex items-center justify-center hover:bg-green-custom hover:text-black transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-zinc-900 rounded-full flex items-center justify-center hover:bg-green-custom hover:text-black transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-zinc-900 rounded-full flex items-center justify-center hover:bg-green-custom hover:text-black transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-16 pt-8 border-t border-zinc-900 text-center text-gray-600 text-xs">
                &copy; {{ date('Y') }} THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/+2340000000000" target="_blank" class="fixed bottom-6 right-6 z-[100] bg-green-500 w-14 h-14 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.5)] hover:scale-110 transition-transform">
        <i class="fa-brands fa-whatsapp text-white text-3xl"></i>
    </a>
</body>
</html>
