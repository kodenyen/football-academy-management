<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
                {{ __('Manage Fixtures') }}
            </h2>
            <a href="{{ route('website.fixtures.create') }}" class="bg-green-500 text-black px-4 py-2 rounded font-black text-xs uppercase tracking-widest hover:bg-green-400 transition">
                Add New Fixture
            </a>
        </div>
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
                                    <th class="pb-3">Opponent</th>
                                    <th class="pb-3">Category</th>
                                    <th class="pb-3">Date & Time</th>
                                    <th class="pb-3">Venue</th>
                                    <th class="pb-3">Score</th>
                                    <th class="pb-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($fixtures as $f)
                                <tr class="border-b border-zinc-800/50 hover:bg-white/5 transition">
                                    <td class="py-4 font-bold italic">{{ $f->opponent }}</td>
                                    <td class="py-4 text-xs font-black text-green-500 uppercase">{{ $f->team_category }}</td>
                                    <td class="py-4 text-gray-400">{{ \Carbon\Carbon::parse($f->match_date)->format('M d, Y H:i') }}</td>
                                    <td class="py-4 text-gray-500 text-xs">{{ $f->venue }}</td>
                                    <td class="py-4 font-mono font-bold">
                                        @if($f->status == 'completed')
                                            {{ $f->our_score }} - {{ $f->opponent_score }}
                                        @else
                                            <span class="text-[10px] text-gray-600 uppercase font-black">{{ $f->status }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('website.fixtures.edit', $f) }}" class="text-yellow-400 hover:text-yellow-300"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('website.fixtures.destroy', $f) }}" method="POST" onsubmit="return confirm('Delete this fixture?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-500 uppercase tracking-widest text-xs font-bold">No fixtures found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $fixtures->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
