<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - THINK RIGHT FOOTBALL ACADEMY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <div class="max-w-md w-full bg-zinc-900 rounded-2xl border border-zinc-800 p-8 shadow-2xl">
            <div class="text-center mb-8">
                <a href="/" class="text-green-500 font-bold text-2xl italic tracking-tighter">THINK RIGHT</a>
                <h1 class="text-2xl font-black uppercase mt-4">Trial Registration</h1>
                <p class="text-gray-400 text-sm mt-2">Join the next generation of football stars.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6 text-sm font-bold text-center">
                    {{ session('success') }}
                    <div class="mt-2">
                         <a href="/" class="underline">Return Home</a>
                    </div>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                    <input type="text" name="name" required class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500 transition outline-none" placeholder="e.g. John Doe">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Age</label>
                        <input type="number" name="age" required class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500 transition outline-none" placeholder="10">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Position</label>
                        <select name="position" required class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500 transition outline-none">
                            <option value="Forward">Forward</option>
                            <option value="Midfielder">Midfielder</option>
                            <option value="Defender">Defender</option>
                            <option value="Goalkeeper">Goalkeeper</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">WhatsApp / Contact Number</label>
                    <input type="text" name="contact_number" required class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500 transition outline-none" placeholder="+234...">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Preferred Trial Date</label>
                    <input type="date" name="trial_date" required class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500 transition outline-none">
                </div>

                <!-- Custom Fields -->
                @foreach($customFields as $field)
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">{{ $field->label }}</label>
                    @if($field->field_type == 'textarea')
                        <textarea name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 transition outline-none"></textarea>
                    @elseif($field->field_type == 'file')
                        <input type="file" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="text-xs text-gray-400">
                    @elseif($field->field_type == 'number')
                        <input type="number" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 transition outline-none">
                    @elseif($field->field_type == 'date')
                        <input type="date" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 transition outline-none">
                    @else
                        <input type="text" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-black border border-zinc-800 rounded-lg px-4 py-3 text-white focus:border-green-500 transition outline-none">
                    @endif
                </div>
                @endforeach

                <button type="submit" class="w-full bg-green-500 text-black py-4 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition transform hover:scale-[1.02] shadow-lg shadow-green-500/20">
                    Submit Registration
                </button>
            </form>
            
            <p class="text-center text-gray-600 text-[10px] mt-8 uppercase tracking-widest">
                By submitting, you agree to our terms and conditions.
            </p>
        </div>
    </div>
</body>
</html>
