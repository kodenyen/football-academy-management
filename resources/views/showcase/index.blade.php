<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talent Showcase - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-zinc-900 text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <a href="/" class="text-green-500 font-bold text-xl italic tracking-tighter uppercase">{{ $settings->academy_name }}</a>
            <a href="/" class="text-sm font-medium hover:text-green-500 transition">Back to Home</a>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black italic uppercase tracking-tighter mb-2">Talent <span class="text-green-500">Showcase</span></h1>
            <p class="text-gray-500 text-sm mb-12">Discover our rising stars and top performers.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($players as $player)
                <div class="bg-zinc-800 border border-zinc-700 rounded-2xl overflow-hidden hover:border-green-500 transition group">
                    <div class="aspect-square bg-zinc-700 relative">
                        @if($player->profile_photo)
                            <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-600 text-6xl">
                                <i class="fa-solid fa-user-ninja"></i>
                            </div>
                        @endif
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black to-transparent">
                            <span class="bg-green-500 text-black px-2 py-1 rounded text-[10px] font-black uppercase">{{ $player->position }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-black uppercase italic">{{ $player->user->name }}</h3>
                        <p class="text-gray-500 text-xs font-bold uppercase mb-4">U{{ ceil($player->age / 2) * 2 }} Category</p>
                        
                        <div class="space-y-3">
                            @php $stats = $player->stats ?? ['speed' => 50, 'dribbling' => 50]; @endphp
                            @foreach($stats as $label => $val)
                            @if($loop->iteration <= 3)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-[8px] font-black uppercase text-gray-400">{{ $label }}</span>
                                    <span class="text-[8px] font-black text-green-500">{{ $val }}%</span>
                                </div>
                                <div class="w-full bg-zinc-900 h-1 rounded-full">
                                    <div class="bg-green-500 h-1 rounded-full" style="width: {{ $val }}%"></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <p class="col-span-full text-center text-gray-600 py-20">No players featured in the showcase yet.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $players->links() }}
            </div>
        </div>
    </div>
</body>
</html>
