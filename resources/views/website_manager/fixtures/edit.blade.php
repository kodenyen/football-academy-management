<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Edit Fixture') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('website.fixtures.update', $fixture) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Opponent Team</label>
                            <x-text-input name="opponent" value="{{ $fixture->opponent }}" required class="w-full" />
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category</label>
                            <select name="team_category" required class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                <option value="U10" {{ $fixture->team_category == 'U10' ? 'selected' : '' }}>U10</option>
                                <option value="U13" {{ $fixture->team_category == 'U13' ? 'selected' : '' }}>U13</option>
                                <option value="U15" {{ $fixture->team_category == 'U15' ? 'selected' : '' }}>U15</option>
                                <option value="U17" {{ $fixture->team_category == 'U17' ? 'selected' : '' }}>U17</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Match Date & Time</label>
                            <input type="datetime-local" name="match_date" value="{{ \Carbon\Carbon::parse($fixture->match_date)->format('Y-m-d\TH:i') }}" required class="w-full bg-white text-black border-zinc-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Venue</label>
                            <x-text-input name="venue" value="{{ $fixture->venue }}" required class="w-full" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-zinc-800">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Status</label>
                            <select name="status" class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                <option value="scheduled" {{ $fixture->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="completed" {{ $fixture->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="postponed" {{ $fixture->status == 'postponed' ? 'selected' : '' }}>Postponed</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Our Score</label>
                            <x-text-input type="number" name="our_score" value="{{ $fixture->our_score }}" class="w-full" />
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Opponent Score</label>
                            <x-text-input type="number" name="opponent_score" value="{{ $fixture->opponent_score }}" class="w-full" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-400 transition">Update Fixture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
