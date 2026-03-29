<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - {{ $settings->academy_name }}</title>
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
            <h1 class="text-4xl md:text-6xl font-black italic uppercase tracking-tighter mb-4 text-slate-900">Our <span class="text-green-600">Gallery</span></h1>
            <p class="text-slate-500 text-sm mb-16 font-bold uppercase tracking-widest">Capturing greatness in every frame.</p>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($items as $item)
                <div class="relative group aspect-square bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition duration-500">
                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @if($item->title)
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition p-8 flex flex-col justify-end">
                        <span class="text-xs font-black text-white uppercase tracking-widest">{{ $item->title }}</span>
                    </div>
                    @endif
                </div>
                @empty
                <div class="col-span-full py-32 text-center text-slate-300">
                    <i class="fa-solid fa-camera text-6xl mb-6 opacity-20"></i>
                    <p class="uppercase font-black text-xs tracking-[0.2em]">The gallery is being curated.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $items->links() }}
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
