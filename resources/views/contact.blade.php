<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - {{ $settings->academy_name }}</title>
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

    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-12 italic text-center text-slate-900">Get In <span class="text-green-600">Touch</span></h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Info Section -->
                <div class="space-y-12">
                    <div class="prose prose-slate">
                        <p class="text-slate-500 text-lg font-medium leading-relaxed italic">Have questions about our trials, fees, or training programs? Send us a message and our team will get back to you within 24 hours.</p>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-center space-x-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition duration-500">
                            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-3xl">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Visit Us</span>
                                <span class="font-black italic text-slate-900 text-lg uppercase tracking-tight">{{ $settings->address ?? 'Lagos, Nigeria' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition duration-500">
                            <div class="w-16 h-16 bg-slate-900 text-white rounded-2xl flex items-center justify-center text-3xl">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Call Details</span>
                                <span class="font-black italic text-slate-900 text-lg uppercase tracking-tight">{{ $settings->phone_number ?? '+234...' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6 bg-green-600 p-8 rounded-[2.5rem] border border-green-500 shadow-xl hover:bg-green-700 transition duration-500 cursor-pointer text-white" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '234') }}')">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-md text-white rounded-2xl flex items-center justify-center text-3xl">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-white/60 uppercase tracking-widest mb-1">WhatsApp Chat</span>
                                <span class="font-black italic text-white text-lg uppercase tracking-tight">Message us now</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="bg-white p-12 rounded-[3rem] border border-slate-100 shadow-2xl">
                    <form action="#" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-slate-50 text-slate-900 rounded-[1.5rem] border-slate-100 focus:border-green-500 focus:ring-0 p-5 font-bold">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-slate-50 text-slate-900 rounded-[1.5rem] border-slate-100 focus:border-green-500 focus:ring-0 p-5 font-bold">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Your Message</label>
                            <textarea name="message" rows="6" required class="w-full bg-slate-50 text-slate-900 rounded-[1.5rem] border-slate-100 focus:border-green-500 focus:ring-0 p-5 font-bold" placeholder="How can we help you?"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white py-6 rounded-[1.5rem] font-black uppercase tracking-widest hover:bg-green-600 transition shadow-xl transform active:scale-95">Send Message</button>
                    </form>
                </div>
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
