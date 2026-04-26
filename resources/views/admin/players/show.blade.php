<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Player Profile Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-100">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8 mb-10 pb-10 border-b border-zinc-800">
                        <div class="w-48 h-48 rounded-2xl bg-zinc-800 overflow-hidden border-2 border-primary/30 shadow-2xl">
                            @if($player->profile_photo)
                                <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-700">
                                    <i class="fa-solid fa-user text-6xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <h3 class="text-4xl font-black italic tracking-tighter uppercase mb-2">{{ $player->user->name }}</h3>
                            <p class="text-primary font-bold uppercase tracking-widest text-sm mb-4">{{ $player->position }} | {{ $player->age }} Years Old</p>
                            <div class="grid grid-cols-2 gap-4 text-xs font-bold uppercase tracking-widest text-zinc-500">
                                <div class="bg-black/30 p-3 rounded-lg border border-zinc-800">
                                    <span class="block text-zinc-600 mb-1">Email</span>
                                    <span class="text-zinc-300">{{ $player->user->email }}</span>
                                </div>
                                <div class="bg-black/30 p-3 rounded-lg border border-zinc-800">
                                    <span class="block text-zinc-600 mb-1">Role</span>
                                    <span class="text-zinc-300">{{ $player->user->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <section>
                            <h4 class="text-lg font-black uppercase italic tracking-tighter text-zinc-400 mb-6 border-l-4 border-primary pl-4">Personal Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 italic">
                                @php
                                    $reg = \App\Models\Registration::where('email', $player->user->email)->first();
                                @endphp
                                
                                @if($reg)
                                    <div class="space-y-1">
                                        <span class="text-[10px] font-black uppercase text-zinc-600">Full Name</span>
                                        <p class="text-zinc-300">{{ $reg->name }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[10px] font-black uppercase text-zinc-600">Date of Birth</span>
                                        <p class="text-zinc-300">{{ \Carbon\Carbon::parse($reg->date_of_birth)->format('d M, Y') }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[10px] font-black uppercase text-zinc-600">Gender</span>
                                        <p class="text-zinc-300">{{ $reg->gender }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[10px] font-black uppercase text-zinc-600">State of Origin / LGA</span>
                                        <p class="text-zinc-300">{{ $reg->state_of_origin }} / {{ $reg->lga }}</p>
                                    </div>
                                    <div class="col-span-full space-y-1">
                                        <span class="text-[10px] font-black uppercase text-zinc-600">Home Address</span>
                                        <p class="text-zinc-300">{{ $reg->address }}</p>
                                    </div>
                                @else
                                    <p class="text-zinc-500 text-xs italic">Registration data not found for this user.</p>
                                @endif
                            </div>
                        </section>

                        @if($reg)
                        <section>
                            <h4 class="text-lg font-black uppercase italic tracking-tighter text-zinc-400 mb-6 border-l-4 border-primary pl-4">Guardian Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 italic">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-black uppercase text-zinc-600">Guardian Name</span>
                                    <p class="text-zinc-300">{{ $reg->guardian_name }}</p>
                                </div>
                                <div class="space-y-1">
                                    <span class="text-[10px] font-black uppercase text-zinc-600">Guardian Contact</span>
                                    <p class="text-zinc-300">{{ $reg->guardian_contact }}</p>
                                </div>
                                <div class="col-span-full space-y-1">
                                    <span class="text-[10px] font-black uppercase text-zinc-600">Guardian Address</span>
                                    <p class="text-zinc-300">{{ $reg->guardian_address }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <h4 class="text-xs font-black uppercase text-zinc-600 mb-4">Player Signature</h4>
                                <div class="bg-black/40 border border-zinc-800 rounded-xl p-4">
                                    <img src="{{ $reg->player_signature }}" class="max-h-32 mx-auto invert opacity-70">
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xs font-black uppercase text-zinc-600 mb-4">Guardian Signature</h4>
                                <div class="bg-black/40 border border-zinc-800 rounded-xl p-4">
                                    <img src="{{ $reg->guardian_signature }}" class="max-h-32 mx-auto invert opacity-70">
                                </div>
                            </div>
                        </section>
                        @endif
                    </div>

                    <div class="mt-12 pt-10 border-t border-zinc-800 flex justify-between">
                        <a href="{{ route('admin.players.index') }}" class="text-zinc-500 hover:text-white transition uppercase text-[10px] font-black tracking-widest">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Back to list
                        </a>
                        <div class="space-x-4">
                             <a href="{{ route('player.pdf', $player) }}" class="bg-primary text-black px-6 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:brightness-110 transition">Download ID Card</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
