<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Manage Registered Players') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6 text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-zinc-800 text-gray-500 text-xs uppercase tracking-widest">
                                    <th class="pb-3">Player</th>
                                    <th class="pb-3">Contact/Login</th>
                                    <th class="pb-3">Position</th>
                                    <th class="pb-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($players as $player)
                                <tr class="border-b border-zinc-800/50 hover:bg-white/5 transition">
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-zinc-800 flex-shrink-0 overflow-hidden border border-zinc-700">
                                                @if($player->profile_photo)
                                                    <img src="{{ asset('storage/' . $player->profile_photo) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                                        <i class="fa-solid fa-user text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="block font-bold text-base">{{ $player->user->name ?? 'Unknown' }}</span>
                                                <span class="text-[10px] text-gray-500 uppercase tracking-widest">Age: {{ $player->age }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <span class="block text-zinc-300">{{ $player->user->email ?? 'N/A' }}</span>
                                        <span class="text-[10px] text-zinc-500 font-mono italic">Pass: [Phone Number]</span>
                                    </td>
                                    <td class="py-4 font-bold uppercase italic text-primary tracking-tighter">{{ $player->position }}</td>
                                    <td class="py-4 text-right">
                                        <div class="inline-flex space-x-2">
                                            <a href="{{ route('admin.players.show', $player) }}" class="bg-zinc-800 text-zinc-300 border border-zinc-700 px-3 py-1 rounded text-[10px] font-bold uppercase hover:bg-zinc-700 transition">View Profile</a>
                                            <form action="{{ route('admin.players.destroy', $player) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this player and their login account?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-red-500/10 text-red-500 border border-red-500/30 px-3 py-1 rounded text-[10px] font-bold uppercase hover:bg-red-500 hover:text-black transition">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-500 uppercase tracking-widest text-xs font-bold">No players registered yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $players->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
