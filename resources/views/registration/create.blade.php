<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Join the Elite - THINK RIGHT FOOTBALL ACADEMY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    @php
        $settings = \App\Models\SiteSetting::first();
        $primaryColor = $settings->primary_color ?? '#00FF41';
    @endphp
    <style>
        :root { --primary-color: {{ $primaryColor }}; }
        .signature-pad {
            border: 2px dashed #334155;
            border-radius: 1rem;
            background-color: rgba(30, 41, 59, 0.5);
            width: 100%;
            height: 200px;
        }
    </style>
</head>
<body class="bg-slate-950 text-white font-sans antialiased min-h-screen relative overflow-x-hidden pb-20">
    <!-- Decorative background elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px] -z-10 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-primary/5 rounded-full blur-[100px] -z-10 animate-pulse" style="animation-delay: 2s"></div>

    <div class="mb-12 text-center transform transition duration-700 hover:scale-110">
        <a href="/" class="flex items-center justify-center space-x-3">
            @if($settings && $settings->academy_logo)
                <img src="{{ asset('storage/' . $settings->academy_logo) }}" alt="Logo" class="w-16 h-16 object-contain">
            @else
                <div class="bg-primary p-2 rounded-xl rotate-12 group-hover:rotate-0 transition-transform">
                    <svg class="w-8 h-8 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            @endif
            <span class="text-3xl font-black italic tracking-tighter uppercase leading-none">
                {{ $settings->academy_name ?? 'ThinkRightFA' }}
            </span>
        </a>
    </div>
        <div class="{{ isset($isDirect) ? 'max-w-4xl' : 'max-w-xl' }} w-full card-elite-dark bg-slate-900/60 backdrop-blur-xl border-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
            @if(isset($isDirect))
            <div class="bg-blue-500/10 border border-blue-500/50 p-4 rounded-xl mb-8 text-center animate-pulse">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">
                    <i class="fa-solid fa-circle-info mr-2"></i> After registration, use your <span class="text-white">Email</span> as Username and <span class="text-white">Phone Number</span> as Password to login.
                </p>
            </div>
            @endif

            <div class="text-center mb-10">
                <h1 class="text-4xl font-black heading-elite tracking-tight mb-2">
                    {{ isset($isDirect) ? 'Player' : 'Book Your' }} <span class="text-primary">{{ isset($isDirect) ? 'Registration' : 'Trial' }}</span>
                </h1>
                <p class="text-slate-400 font-medium italic">
                    {{ isset($isDirect) ? 'Complete your official academy registration.' : 'Unleash your potential with the elite academy.' }}
                </p>
            </div>

            @if(session('success'))
                <div class="bg-primary/10 border border-primary text-primary p-5 rounded-2xl mb-8 flex items-center space-x-4 animate-bounce">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <div>
                        <p class="font-black uppercase text-sm tracking-widest">{{ session('success') }}</p>
                        @if(isset($isDirect))
                            <a href="{{ route('login') }}" class="text-xs underline hover:text-white transition uppercase font-bold mt-1 inline-block">Login Now</a>
                        @else
                            <a href="/" class="text-xs underline hover:text-white transition uppercase font-bold mt-1 inline-block">Return Home</a>
                        @endif
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500 text-red-500 p-5 rounded-2xl mb-8">
                    <ul class="list-disc list-inside text-xs font-bold uppercase tracking-widest">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($isDirect) ? route('register.store_direct') : route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12" id="registrationForm">
                @csrf
                
                @if(isset($isDirect))
                <!-- 1. Player Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 border-b border-slate-800 pb-4">
                        <span class="w-8 h-8 bg-primary/20 text-primary rounded-full flex items-center justify-center font-black">1</span>
                        <h2 class="text-xl font-black uppercase italic tracking-tighter">Player Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">First Name</label>
                            <input type="text" name="first_name" required value="{{ old('first_name') }}" class="input-elite" placeholder="e.g. John">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Surname</label>
                            <input type="text" name="surname" required value="{{ old('surname') }}" class="input-elite" placeholder="e.g. Doe">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="input-elite" placeholder="Optional">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Date of Birth</label>
                            <input type="date" name="date_of_birth" required value="{{ old('date_of_birth') }}" class="input-elite">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Gender</label>
                            <select name="gender" required class="input-elite">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Home Address</label>
                        <textarea name="address" required rows="2" class="input-elite" placeholder="Street, City, State">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">L.G.A</label>
                            <input type="text" name="lga" required value="{{ old('lga') }}" class="input-elite" placeholder="Local Govt Area">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">State of Origin</label>
                            <input type="text" name="state_of_origin" required value="{{ old('state_of_origin') }}" class="input-elite" placeholder="State">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Phone Number (WhatsApp)</label>
                            <input type="text" name="contact_number" required value="{{ old('contact_number') }}" class="input-elite" placeholder="+234...">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Email Address</label>
                            <input type="email" name="email" required value="{{ old('email') }}" class="input-elite" placeholder="example@mail.com">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-800">
                        <h3 class="text-sm font-black uppercase text-primary mb-4 italic">International Passport (Optional)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Passport Number</label>
                                <input type="text" name="passport_number" value="{{ old('passport_number') }}" class="input-elite" placeholder="A12345678">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Issuing Date</label>
                                <input type="date" name="passport_issuing_date" value="{{ old('passport_issuing_date') }}" class="input-elite">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Expiry Date</label>
                                <input type="date" name="passport_expiry_date" value="{{ old('passport_expiry_date') }}" class="input-elite">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Passport Photograph</label>
                            <div class="relative group">
                                <input type="file" name="passport_photo" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="bg-slate-800/50 border-2 border-dashed border-slate-700 rounded-2xl p-8 text-center group-hover:border-primary transition-colors">
                                    <i class="fa-solid fa-camera text-3xl text-slate-600 mb-3 block"></i>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Upload Photo</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Player's Signature</label>
                            <div class="signature-pad-container">
                                <canvas id="playerSignature" class="signature-pad"></canvas>
                                <input type="hidden" name="player_signature" id="playerSignatureInput">
                                <div class="flex justify-end mt-2">
                                    <button type="button" onclick="clearSignature('playerSignature')" class="text-[9px] font-black uppercase text-red-500 hover:text-red-400">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Position Played -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 border-b border-slate-800 pb-4">
                        <span class="w-8 h-8 bg-primary/20 text-primary rounded-full flex items-center justify-center font-black">2</span>
                        <h2 class="text-xl font-black uppercase italic tracking-tighter">Preferred Position</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['Striker', 'Midfielder', 'Defender', 'Goalkeeper'] as $pos)
                        <label class="relative flex items-center justify-center p-6 bg-slate-800/50 border-2 border-slate-700 rounded-2xl cursor-pointer hover:border-primary/50 transition-all group">
                            <input type="radio" name="position" value="{{ $pos }}" required class="sr-only peer">
                            <span class="text-xs font-black uppercase tracking-widest text-slate-400 peer-checked:text-primary transition-colors">{{ $pos }}</span>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-2xl transition-all"></div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Parent/Guardian Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 border-b border-slate-800 pb-4">
                        <span class="w-8 h-8 bg-primary/20 text-primary rounded-full flex items-center justify-center font-black">3</span>
                        <h2 class="text-xl font-black uppercase italic tracking-tighter">Parent/Guardian Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Guardian's Full Name</label>
                            <input type="text" name="guardian_name" required value="{{ old('guardian_name') }}" class="input-elite" placeholder="Parent or Guardian Name">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Emergency Contact Number</label>
                            <input type="text" name="guardian_contact" required value="{{ old('guardian_contact') }}" class="input-elite" placeholder="+234...">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Guardian's Address</label>
                        <textarea name="guardian_address" required rows="2" class="input-elite" placeholder="Guardian's Home Address">{{ old('guardian_address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">Guardian's Signature</label>
                        <div class="signature-pad-container">
                            <canvas id="guardianSignature" class="signature-pad"></canvas>
                            <input type="hidden" name="guardian_signature" id="guardianSignatureInput">
                            <div class="flex justify-end mt-2">
                                <button type="button" onclick="clearSignature('guardianSignature')" class="text-[9px] font-black uppercase text-red-500 hover:text-red-400">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <!-- TRIAL REGISTRATION (Keep simple) -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Personal Details</label>
                        <div class="space-y-4">
                            <input type="text" name="name" required class="input-elite" placeholder="Player's Full Name">
                            
                            <div class="grid grid-cols-2 gap-4">
                                <input type="number" name="age" required class="input-elite" placeholder="Age">
                                <select name="position" required class="input-elite">
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
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Contact Details</label>
                        <div class="space-y-4">
                            <input type="email" name="email" required class="input-elite" placeholder="Email Address">
                            <input type="text" name="contact_number" required class="input-elite" placeholder="WhatsApp / Contact Number">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Schedule Trial</label>
                        <input type="date" name="trial_date" required class="input-elite">
                    </div>
                </div>
                @endif

                <button type="submit" onclick="prepareSignatures()" class="w-full bg-primary text-slate-950 py-6 rounded-2xl font-black uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all shadow-[0_10px_30px_rgba(0,255,65,0.3)] flex items-center justify-center group">
                    <span>Complete {{ isset($isDirect) ? 'Player' : 'Trial' }} Registration</span>
                    <i class="fa-solid fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </button>
            </form>
            
            <p class="text-center text-slate-600 text-[10px] mt-10 uppercase tracking-[0.2em] font-black">
                Think Right Football Academy &copy; {{ date('Y') }}
            </p>
        </div>
    </div>

    <script>
        let playerPad, guardianPad;

        window.onload = function() {
            @if(isset($isDirect))
                const playerCanvas = document.getElementById('playerSignature');
                const guardianCanvas = document.getElementById('guardianSignature');
                
                if(playerCanvas) playerPad = new SignaturePad(playerCanvas);
                if(guardianCanvas) guardianPad = new SignaturePad(guardianCanvas);

                // Make canvas responsive
                function resizeCanvas() {
                    [playerCanvas, guardianCanvas].forEach(canvas => {
                        if(!canvas) return;
                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                        canvas.width = canvas.offsetWidth * ratio;
                        canvas.height = canvas.offsetHeight * ratio;
                        canvas.getContext("2d").scale(ratio, ratio);
                    });
                }

                window.onresize = resizeCanvas;
                resizeCanvas();
            @endif
        }

        function clearSignature(id) {
            if(id === 'playerSignature' && playerPad) playerPad.clear();
            if(id === 'guardianSignature' && guardianPad) guardianPad.clear();
        }

        function prepareSignatures() {
            if(playerPad && !playerPad.isEmpty()) {
                document.getElementById('playerSignatureInput').value = playerPad.toDataURL();
            }
            if(guardianPad && !guardianPad.isEmpty()) {
                document.getElementById('guardianSignatureInput').value = guardianPad.toDataURL();
            }
        }
    </script>

    <style>
        .input-elite {
            width: 100%;
            background-color: rgba(30, 41, 59, 0.5);
            border: 1px solid #334155;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            color: white;
            transition: all 0.3s;
            outline: none;
            font-weight: 500;
        }
        .input-elite:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0, 255, 65, 0.1);
        }
        .input-elite::placeholder {
            color: #475569;
        }
        select.input-elite {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.5em 1.5em;
        }
    </style>
</body>
</html>
