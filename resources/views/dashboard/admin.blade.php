<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Stat Card -->
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-400 text-sm uppercase font-black">Total Players</div>
                    <div class="text-3xl font-black text-green-500 mt-2">124</div>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-400 text-sm uppercase font-black">Pending Trials</div>
                    <div class="text-3xl font-black text-yellow-500 mt-2">12</div>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-400 text-sm uppercase font-black">Upcoming Matches</div>
                    <div class="text-3xl font-black text-blue-500 mt-2">3</div>
                </div>
            </div>

            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-xl font-black mb-4 uppercase italic">Recent Trial Registrations</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-zinc-800 text-gray-500 text-xs uppercase tracking-widest">
                                    <th class="pb-3">Name</th>
                                    <th class="pb-3">Age</th>
                                    <th class="pb-3">Position</th>
                                    <th class="pb-3">Trial Date</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="border-b border-zinc-800/50">
                                    <td class="py-4">John Doe</td>
                                    <td class="py-4">12</td>
                                    <td class="py-4">Forward</td>
                                    <td class="py-4">Apr 10, 2026</td>
                                    <td class="py-4"><span class="bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded text-[10px] font-bold uppercase">Pending</span></td>
                                    <td class="py-4"><button class="text-green-500 font-bold hover:underline">Manage</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
