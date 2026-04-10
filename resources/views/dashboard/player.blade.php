<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$player)
                <div class="bg-yellow-500/10 border border-yellow-500 text-yellow-500 p-6 rounded-xl mb-6">
                    <h3 class="font-black uppercase italic">Profile Incomplete</h3>
                    <p class="text-sm mt-2">Your player profile has not been set up yet. Please contact the administrator.</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Player Profile Card -->
                <div class="col-span-1 md:col-span-1">
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl text-center shadow-sm">
                        <div class="relative inline-block mx-auto mb-6">
                            <div class="w-32 h-32 bg-zinc-800 rounded-full flex items-center justify-center border-4 border-green-500 mx-auto overflow-hidden">
                                @if($player && $player->profile_photo)
                                    <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fa-solid fa-user text-5xl text-gray-600"></i>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-2xl font-black uppercase italic text-white">{{ Auth::user()->name }}</h3>
                        <p class="text-green-500 font-bold uppercase tracking-widest text-sm">{{ $player->position ?? 'Player' }} | {{ $player->age ?? 'N/A' }} yrs</p>
                        
                        <div class="grid grid-cols-2 gap-4 mt-8 border-t border-zinc-800 pt-8">
                            <div>
                                <span class="block text-gray-500 text-xs uppercase font-bold">Category</span>
                                <span class="font-black text-xl text-white">U{{ $player && $player->age ? ceil($player->age / 2) * 2 : '15' }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 text-xs uppercase font-bold">Foot</span>
                                <span class="font-black text-xl text-white">{{ $player->preferred_foot ?? 'Right' }}</span>
                            </div>
                        </div>

                        <div class="mt-8 space-y-3">
                             <a href="{{ route('profile.edit') }}" class="block w-full border border-zinc-700 text-gray-300 py-3 rounded-xl font-bold hover:bg-zinc-800 transition flex items-center justify-center">
                                <i class="fa-solid fa-pen mr-2"></i> Edit Profile
                             </a>
                             @if($player)
                             <a href="{{ route('player.pdf', $player) }}" class="block w-full bg-zinc-800 text-white py-3 rounded-xl font-bold hover:bg-zinc-700 transition flex items-center justify-center">
                                <i class="fa-solid fa-file-pdf mr-2 text-red-500"></i> Download Profile CV
                             </a>
                             <div class="p-4 bg-white rounded-xl inline-block mx-auto mt-4">
                                <img src="{{ route('player.qr', $player) }}" class="w-24 h-24">
                                <span class="block text-[8px] text-black font-black uppercase mt-1">Scan for Scout Profile</span>
                             </div>
                             @endif
                        </div>
                    </div>
                </div>

                <!-- Stats & Reports -->
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <!-- Performance Stats -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-black mb-6 uppercase italic flex items-center text-white">
                            <i class="fa-solid fa-bolt text-green-500 mr-3"></i> Performance Stats
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @php
                                $stats = $player->stats ?? ['speed' => 50, 'dribbling' => 50, 'shooting' => 50, 'passing' => 50];
                            @endphp
                            @foreach($stats as $label => $value)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">{{ $label }}</span>
                                    <span class="text-xs font-black text-green-500">{{ $value }}%</span>
                                </div>
                                <div class="w-full bg-zinc-800 h-2 rounded-full">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $value }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Attendance Tracking -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-black mb-6 uppercase italic text-white">Attendance History (Last 10)</h3>
                        <div class="flex flex-wrap gap-2">
                             @forelse($attendances as $att)
                                <div class="w-10 h-10 rounded-md flex flex-col items-center justify-center border {{ $att->status == 'present' ? 'bg-green-500/20 border-green-500/50 text-green-500' : ($att->status == 'absent' ? 'bg-red-500/20 border-red-500/50 text-red-500' : 'bg-blue-500/20 border-blue-500/50 text-blue-500') }}">
                                    <span class="text-[10px] font-bold">{{ strtoupper(substr($att->status, 0, 1)) }}</span>
                                    <span class="text-[8px] opacity-50">{{ \Carbon\Carbon::parse($att->date)->format('d/m') }}</span>
                                </div>
                             @empty
                                <p class="text-gray-500 text-xs italic">No attendance records found.</p>
                             @endforelse
                        </div>
                    </div>

                    <!-- Coach Reports -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-black mb-6 uppercase italic text-white">Coach Feedback</h3>
                        <div class="space-y-4">
                            @forelse($reports as $report)
                            <div class="bg-black/40 border border-zinc-800 p-4 rounded-xl">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-black uppercase text-green-500">Rating: {{ $report->rating }}/10</span>
                                    <span class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($report->date)->format('M d, Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-300 italic">"{{ $report->feedback }}"</p>
                            </div>
                            @empty
                                <p class="text-gray-500 text-xs italic">No performance reports yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
