<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Add New Fixture') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('website.fixtures.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Opponent Team</label>
                            <x-text-input name="opponent" required class="w-full" />
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category (e.g. U15)</label>
                            <select name="team_category" required class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                <option value="U10">U10</option>
                                <option value="U13">U13</option>
                                <option value="U15">U15</option>
                                <option value="U17">U17</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Match Date & Time</label>
                            <input type="datetime-local" name="match_date" required class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Venue</label>
                            <x-text-input name="venue" required class="w-full" placeholder="Main Stadium" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Status</label>
                        <select name="status" class="w-full bg-white text-black border-zinc-300 rounded-lg">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="postponed">Postponed</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition">Add Fixture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
