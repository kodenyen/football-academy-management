<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-zinc-900 text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <a href="/" class="text-green-500 font-bold text-xl italic tracking-tighter uppercase">{{ $settings->academy_name }}</a>
            <a href="/" class="text-sm font-medium hover:text-green-500 transition">Back to Home</a>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black italic uppercase tracking-tighter mb-2">Our <span class="text-green-500">Gallery</span></h1>
            <p class="text-gray-500 text-sm mb-12">Moments captured during training and matches.</p>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($items as $item)
                <div class="relative group aspect-square bg-zinc-800 rounded-xl overflow-hidden border border-zinc-700">
                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 grayscale group-hover:grayscale-0">
                    @if($item->title)
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition p-4 flex flex-col justify-end">
                        <span class="text-xs font-bold text-white uppercase">{{ $item->title }}</span>
                    </div>
                    @endif
                </div>
                @empty
                <div class="col-span-full py-20 text-center text-gray-600">
                    <i class="fa-solid fa-camera text-4xl mb-4"></i>
                    <p class="uppercase font-black text-xs tracking-widest">No gallery items yet.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</body>
</html>
