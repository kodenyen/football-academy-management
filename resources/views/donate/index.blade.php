<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Our Mission - {{ $settings->academy_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#00FF41' }};
        }
        .text-primary { color: var(--primary-color); }
        .bg-primary { background-color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
        .btn-primary {
            background-color: var(--primary-color);
            color: #000;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 1rem 2rem;
            border-radius: 1rem;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px var(--primary-color);
        }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased selection:bg-primary/30">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-xl w-full">
            <div class="text-center mb-12">
                <a href="/" class="inline-block mb-8">
                    @if($settings->academy_logo)
                        <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-16 w-auto object-contain">
                    @else
                        <div class="bg-primary p-3 rounded-2xl rotate-12 inline-block">
                            <svg class="w-10 h-10 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    @endif
                </a>
                <h1 class="text-4xl md:text-5xl font-black uppercase italic tracking-tighter mb-4">Empower the <span class="text-primary">Future</span></h1>
                <p class="text-slate-400 font-medium italic">Your contribution directly impacts the next generation of football stars.</p>
            </div>

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl mb-8 text-center text-xs font-bold uppercase tracking-widest">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl">
                @if($campaign)
                    <div class="mb-10 pb-10 border-b border-slate-800">
                        <span class="text-[10px] font-black uppercase text-primary tracking-[0.3em] mb-3 inline-block">Supporting Campaign</span>
                        <h2 class="text-2xl font-black uppercase italic text-white leading-none">{{ $campaign->title }}</h2>
                        <p class="text-slate-500 text-sm mt-4 italic">{{ Str::limit($campaign->description, 100) }}</p>
                    </div>
                @endif

                <form action="{{ route('donate.initialize') }}" method="POST" class="space-y-8">
                    @csrf
                    @if($campaign)
                        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-4 ml-2">Donation Amount (NGN)</label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-2xl font-black text-slate-600">₦</span>
                                <input type="number" name="amount" required min="100" placeholder="0.00" 
                                       class="w-full bg-slate-800/50 border-transparent border-2 focus:border-primary focus:ring-0 p-6 pl-14 rounded-2xl font-black text-2xl outline-none transition-all placeholder:text-slate-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-4 ml-2">Your Email Address</label>
                            <input type="email" name="email" required value="{{ auth()->user()?->email }}" placeholder="Enter your email for receipt" 
                                   class="w-full bg-slate-800/50 border-transparent border-2 focus:border-primary focus:ring-0 p-6 rounded-2xl font-bold text-lg outline-none transition-all placeholder:text-slate-700">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full py-6 text-base flex items-center justify-center space-x-4">
                        <i class="fa-solid fa-shield-heart text-xl"></i>
                        <span>Secure Donation</span>
                    </button>

                    <div class="flex items-center justify-center space-x-4 opacity-30 grayscale">
                        <img src="https://paystack.com/assets/img/login/paystack-logo.png" class="h-4">
                        <div class="h-4 w-px bg-slate-700"></div>
                        <span class="text-[8px] font-black uppercase tracking-widest">Secured by Paystack</span>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-600 text-[10px] mt-12 uppercase tracking-[0.2em] font-black">
                <a href="/" class="hover:text-primary transition">← Back to Academy</a>
            </p>
        </div>
    </div>
</body>
</html>
