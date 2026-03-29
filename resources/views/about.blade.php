<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
        }
        .bg-primary-custom { background-color: var(--primary-color); }
        .text-primary-custom { color: var(--primary-color); }
        .border-primary-custom { border-color: var(--primary-color); }
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

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-6 italic text-slate-900">About Our <span class="text-green-600">Academy</span></h1>
                    <div class="h-1.5 w-20 bg-green-500 mb-10 rounded-full"></div>
                    <div class="prose prose-slate prose-lg text-slate-600 italic leading-relaxed font-medium">
                        {!! nl2br(e($settings->about_us_content ?: 'Empowering the next generation of football stars through professional coaching and disciplined training.')) !!}
                    </div>
                    
                    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm">
                            <span class="block text-xl font-black text-slate-900 uppercase italic">Our Vision</span>
                            <p class="text-slate-500 text-sm mt-3 leading-relaxed">{{ $settings->about_vision ?: 'To be the leading football academy recognized globally for developing elite talent.' }}</p>
                        </div>
                        <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm">
                            <span class="block text-xl font-black text-slate-900 uppercase italic">Our Mission</span>
                            <p class="text-slate-500 text-sm mt-3 leading-relaxed">{{ $settings->about_mission ?: 'Providing world-class training facilities and professional coaching to unlock every player\'s full potential.' }}</p>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div class="aspect-video sm:aspect-square bg-slate-200 rounded-[3rem] overflow-hidden border-8 border-white shadow-2xl relative">
                        <iframe class="absolute inset-0 w-full h-full grayscale group-hover:grayscale-0 transition duration-700" 
                                src="https://www.youtube.com/embed/{{ $settings->about_video_id ?? 'dQw4w9WgXcQ' }}?autoplay=1&mute=1&loop=1&playlist={{ $settings->about_video_id ?? 'dQw4w9WgXcQ' }}&controls=0" 
                                frameborder="0" allow="autoplay; encrypted-media"></iframe>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-green-500 rounded-full -z-10 opacity-10 blur-3xl group-hover:opacity-20 transition"></div>
                </div>
            </div>
        </div>
    </div>

    @php $facilities = \App\Models\Facility::orderBy('order')->get(); @endphp
    @if($facilities->count() > 0)
    <!-- Facilities Section -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter italic text-slate-900">World-Class <span class="text-green-600">Facilities</span></h2>
                <div class="h-1.5 w-20 bg-green-500 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($facilities as $facility)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 hover:shadow-2xl transition duration-500">
                    <div class="h-72 bg-slate-200 overflow-hidden">
                        @if($facility->image)
                            <img src="{{ asset('storage/' . $facility->image) }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 text-5xl font-black italic">TRFA</div>
                        @endif
                    </div>
                    <div class="p-10">
                        <h3 class="text-2xl font-black uppercase italic text-slate-900">{{ $facility->name }}</h3>
                        <p class="text-slate-500 text-sm mt-4 font-medium leading-relaxed italic">{{ $facility->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-slate-900 py-16 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">{{ $settings->footer_text }}</p>
        </div>
    </footer>
</body>
</html>
