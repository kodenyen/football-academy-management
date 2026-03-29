<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talent Showcase - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
        }
        body { background-color: #f8fafc; color: #0f172a; }
    </style>
</head>
<body class="text-slate-900 font-sans antialiased bg-slate-50">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <a href="/" class="text-slate-900 font-black text-xl italic tracking-tighter uppercase">
                THINK<span class="text-green-600">RIGHT</span>
            </a>
            <a href="/" class="text-sm font-black text-green-600 hover:text-green-700 transition uppercase tracking-widest border-b-2 border-green-600">Back to Home</a>
        </div>
    </nav>

    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-black italic uppercase tracking-tighter mb-4 text-slate-900">Talent <span class="text-green-600">Showcase</span></h1>
            <p class="text-slate-500 text-sm mb-16 font-bold uppercase tracking-widest">Scouting the next generation of elite footballers.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                @forelse($players as $player)
                <div class="bg-white border border-slate-100 rounded-[2.5rem] overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <div class="aspect-square bg-slate-100 relative overflow-hidden">
                        @if($player->profile_photo)
                            <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-200 text-7xl">
                                <i class="fa-solid fa-user-ninja"></i>
                            </div>
                        @endif
                        <div class="absolute bottom-6 left-6">
                            <span class="bg-green-600 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl">{{ $player->position }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-black uppercase italic text-slate-900 tracking-tight">{{ $player->user->name }}</h3>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-6">U{{ ceil($player->age / 2) * 2 }} Category</p>
                        
                        <div class="space-y-4">
                            @php $stats = $player->stats ?? ['speed' => 50, 'dribbling' => 50]; @endphp
                            @foreach($stats as $label => $val)
                            @if($loop->iteration <= 3)
                            <div>
                                <div class="flex justify-between mb-1.5">
                                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest">{{ $label }}</span>
                                    <span class="text-[9px] font-black text-green-600">{{ $val }}%</span>
                                </div>
                                <div class="w-full bg-slate-50 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-green-500 h-full rounded-full transition-all duration-1000" style="width: {{ $val }}%"></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        
                        <a href="{{ route('player.pdf', $player) }}" class="mt-8 block w-full bg-slate-900 text-white text-center py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-green-600 transition shadow-lg">Download CV</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center text-slate-300">
                    <i class="fa-solid fa-users text-6xl mb-6 opacity-20"></i>
                    <p class="uppercase font-black text-xs tracking-[0.2em]">Our talent pool is growing.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $players->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 py-16 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">{{ $settings->footer_text }}</p>
        </div>
    </footer>
</body>
</html>
