<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color }};
            --bg-color: {{ $settings->background_color ?? '#18181b' }};
        }
        .bg-primary-custom { background-color: var(--primary-color); }
        .text-primary-custom { color: var(--primary-color); }
        .border-primary-custom { border-color: var(--primary-color); }
        body { background-color: var(--bg-color); }
    </style>
</head>
<body class="text-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <a href="/" class="text-primary-custom font-bold text-xl italic tracking-tighter uppercase">{{ $settings->academy_name }}</a>
            <a href="/" class="text-sm font-medium hover:text-primary-custom transition underline">Back to Home</a>
        </div>
    </nav>

    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-12 italic text-center">Get In <span class="text-primary-custom">Touch</span></h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Info Section -->
                <div class="space-y-12">
                    <div class="prose prose-invert">
                        <p class="text-gray-400 text-lg">Have questions about our trials, fees, or training programs? Send us a message and our team will get back to you within 24 hours.</p>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-center space-x-6 bg-zinc-800/50 p-6 rounded-3xl border border-zinc-700">
                            <div class="w-14 h-14 bg-primary-custom text-black rounded-2xl flex items-center justify-center text-2xl shadow-lg">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-gray-500 uppercase tracking-widest">Visit Us</span>
                                <span class="font-bold italic text-white">{{ $settings->address ?? 'Lagos, Nigeria' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6 bg-zinc-800/50 p-6 rounded-3xl border border-zinc-700">
                            <div class="w-14 h-14 bg-zinc-900 text-primary-custom border border-primary-custom rounded-2xl flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-gray-500 uppercase tracking-widest">Call Details</span>
                                <span class="font-bold italic text-white">{{ $settings->phone_number ?? '+234...' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6 bg-zinc-800/50 p-6 rounded-3xl border border-zinc-700 hover:border-green-500 transition cursor-pointer" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '234') }}')">
                            <div class="w-14 h-14 bg-green-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-green-500/20 shadow-xl">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-gray-500 uppercase tracking-widest">WhatsApp Chat</span>
                                <span class="font-bold italic text-green-500">Message us now</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="bg-zinc-800 p-10 rounded-[2.5rem] border border-zinc-700 shadow-2xl">
                    <form action="#" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-white text-black rounded-2xl border-zinc-300 focus:ring-primary-custom p-4 font-bold">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-white text-black rounded-2xl border-zinc-300 focus:ring-primary-custom p-4 font-bold">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Your Message</label>
                            <textarea name="message" rows="6" required class="w-full bg-white text-black rounded-2xl border-zinc-300 focus:ring-primary-custom p-4 font-bold" placeholder="How can we help you?"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary-custom text-black py-5 rounded-2xl font-black uppercase tracking-widest hover:opacity-80 transition shadow-xl transform active:scale-95">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-zinc-900 py-16 border-t border-zinc-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 text-xs">{{ $settings->footer_text }}</p>
        </div>
    </footer>
</body>
</html>
