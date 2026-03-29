<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Mark Attendance') }}
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
                <form action="{{ route('coach.attendance.store') }}" method="POST">
                    @csrf
                    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Training Date</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="bg-white text-black rounded-lg border-zinc-300 focus:ring-green-500">
                        </div>
                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-xs tracking-widest hover:bg-green-400 transition">Save Attendance</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-zinc-800 text-gray-500 text-xs uppercase tracking-widest">
                                    <th class="pb-3">Player Name</th>
                                    <th class="pb-3 text-center">Present</th>
                                    <th class="pb-3 text-center">Absent</th>
                                    <th class="pb-3 text-center">Excused</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800/50">
                                @foreach($players as $player)
                                <tr>
                                    <td class="py-4 font-bold text-sm">{{ $player->user->name }}</td>
                                    <td class="py-4 text-center">
                                        <input type="radio" name="attendance[{{ $player->id }}]" value="present" checked class="text-green-500 focus:ring-green-500 bg-zinc-800 border-zinc-700">
                                    </td>
                                    <td class="py-4 text-center">
                                        <input type="radio" name="attendance[{{ $player->id }}]" value="absent" class="text-red-500 focus:ring-red-500 bg-zinc-800 border-zinc-700">
                                    </td>
                                    <td class="py-4 text-center">
                                        <input type="radio" name="attendance[{{ $player->id }}]" value="excused" class="text-blue-500 focus:ring-blue-500 bg-zinc-800 border-zinc-700">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
