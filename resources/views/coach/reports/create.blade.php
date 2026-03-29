<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Upload Performance Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6 text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('coach.reports.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Select Player</label>
                            <select name="player_id" required class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500">
                                <option value="">-- Choose Player --</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Report Date</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500" required>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Ratings (1-10)</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach(['Speed', 'Dribbling', 'Shooting', 'Passing'] as $metric)
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1">{{ $metric }}</label>
                                <input type="number" name="metrics[{{ strtolower($metric) }}]" min="1" max="10" value="5" class="w-full bg-white text-black border-zinc-300 rounded-lg">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Overall Rating (1-10)</label>
                        <input type="range" name="rating" min="1" max="10" step="1" value="5" class="w-full accent-green-500" oninput="this.nextElementSibling.value = this.value">
                        <output class="block text-center font-black text-2xl text-green-500">5</output>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Coach's Feedback & Comments</label>
                        <textarea name="feedback" rows="4" class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500" placeholder="Provide detailed feedback..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition transform hover:scale-[1.02] shadow-lg shadow-green-500/20">
                            Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
