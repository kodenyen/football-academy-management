<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Join the Elite - THINK RIGHT FOOTBALL ACADEMY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @php
        $settings = \App\Models\SiteSetting::first();
        $primaryColor = $settings->primary_color ?? '#00FF41';
    @endphp
    <style>
        :root { --primary-color: {{ $primaryColor }}; }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased min-h-screen relative overflow-x-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px] -z-10 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-primary/5 rounded-full blur-[100px] -z-10 animate-pulse" style="animation-delay: 2s"></div>

    <div class="flex flex-col items-center justify-center px-4 py-16">
        <!-- Logo -->
        <div class="mb-12 text-center transform transition duration-700 hover:scale-110">
            <a href="/" class="flex items-center justify-center space-x-3">
                <div class="bg-primary p-2 rounded-xl rotate-12 group-hover:rotate-0 transition-transform">
                    <svg class="w-8 h-8 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-3xl font-black italic tracking-tighter uppercase leading-none">
                    ThinkRight<span class="text-primary">FA</span>
                </span>
            </a>
        </div>

        <div class="max-w-xl w-full card-elite-dark bg-slate-900/60 backdrop-blur-xl border-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black heading-elite tracking-tight mb-2">Book Your <span class="text-primary">Trial</span></h1>
                <p class="text-slate-400 font-medium italic">Unleash your potential with the elite academy.</p>
            </div>

            @if(session('success'))
                <div class="bg-primary/10 border border-primary text-primary p-5 rounded-2xl mb-8 flex items-center space-x-4 animate-bounce">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <div>
                        <p class="font-black uppercase text-sm tracking-widest">{{ session('success') }}</p>
                        <a href="/" class="text-xs underline hover:text-white transition uppercase font-bold mt-1 inline-block">Return Home</a>
                    </div>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Personal Details</label>
                        <div class="space-y-4">
                            <input type="text" name="name" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none placeholder:text-slate-600 font-medium" placeholder="Player's Full Name">
                            
                            <div class="grid grid-cols-2 gap-4">
                                <input type="number" name="age" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none placeholder:text-slate-600 font-medium" placeholder="Age">
                                <select name="position" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none font-medium appearance-none">
                                    <option value="" disabled selected>Preferred Position</option>
                                    <option value="Forward">Forward</option>
                                    <option value="Midfielder">Midfielder</option>
                                    <option value="Defender">Defender</option>
                                    <option value="Goalkeeper">Goalkeeper</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Contact Info</label>
                        <input type="text" name="contact_number" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none placeholder:text-slate-600 font-medium" placeholder="WhatsApp / Contact Number">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Schedule</label>
                        <div class="relative">
                            <input type="date" name="trial_date" required class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none font-medium">
                        </div>
                    </div>

                    <!-- Custom Fields -->
                    @if(count($customFields) > 0)
                        <div class="pt-4 border-t border-slate-800">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-5 ml-1">Additional Information</label>
                            <div class="space-y-4">
                                @foreach($customFields as $field)
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 mb-2 ml-1">{{ $field->label }}</label>
                                    @if($field->field_type == 'textarea')
                                        <textarea name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none placeholder:text-slate-600 font-medium h-32" placeholder="Tell us more..."></textarea>
                                    @else
                                        <input type="{{ $field->field_type }}" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 text-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none placeholder:text-slate-600 font-medium">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <button type="submit" class="w-full bg-primary text-slate-950 py-5 rounded-2xl font-black uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all shadow-[0_10px_30px_rgba(0,255,65,0.3)] flex items-center justify-center group">
                    <span>Submit Registration</span>
                    <i class="fa-solid fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </button>
            </form>
            
            <p class="text-center text-slate-600 text-[10px] mt-10 uppercase tracking-[0.2em] font-black">
                Think Right Football Academy &copy; {{ date('Y') }}
            </p>
        </div>
    </div>
</body>
</html>
