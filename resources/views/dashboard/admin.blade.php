<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Stat Card -->
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-400 text-sm uppercase font-black">Total Players</div>
                    <div class="text-3xl font-black text-green-500 mt-2">{{ $totalPlayers }}</div>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:border-green-500 transition cursor-pointer" onclick="window.location='{{ route('admin.coaches.index') }}'">
                    <div class="text-gray-400 text-sm uppercase font-black">Total Coaches</div>
                    <div class="text-3xl font-black text-green-500 mt-2">{{ $totalCoaches }}</div>
                    <div class="text-[10px] text-gray-600 mt-2 uppercase font-black">Manage Coaches →</div>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:border-green-500 transition cursor-pointer" onclick="window.location='{{ route('admin.trials.index') }}'">
                    <div class="text-gray-400 text-sm uppercase font-black">Pending Trials</div>
                    <div class="text-3xl font-black text-yellow-500 mt-2">{{ $pendingTrialsCount }}</div>
                    <div class="text-[10px] text-gray-600 mt-2 uppercase font-black">Manage Trials →</div>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:border-green-500 transition cursor-pointer" onclick="window.location='{{ route('website.settings.index') }}'">
                    <div class="text-gray-400 text-sm uppercase font-black">Site Settings</div>
                    <div class="text-3xl font-black text-blue-500 mt-2"><i class="fa-solid fa-sliders"></i></div>
                    <div class="text-[10px] text-gray-600 mt-2 uppercase font-black">Manage Website & WhatsApp →</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Shareable Links -->
                <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl lg:col-span-2">
                    <h3 class="text-xl font-black mb-6 uppercase italic text-white flex items-center">
                        <i class="fa-solid fa-share-nodes text-green-500 mr-3"></i> Shareable Registration Links
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-black/40 p-6 rounded-xl border border-zinc-800">
                            <span class="block text-[10px] font-black uppercase text-gray-500 mb-2 tracking-widest">Public Trial Link (Requires Approval)</span>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly value="{{ route('register.trial') }}" class="flex-1 bg-zinc-800 border-none rounded-lg text-xs text-gray-300 py-3 px-4 focus:ring-0">
                                <button onclick="copyToClipboard('{{ route('register.trial') }}')" class="bg-green-500 text-black p-3 rounded-lg hover:bg-green-400 transition">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-black/40 p-6 rounded-xl border border-green-500/20 shadow-lg shadow-green-500/5">
                            <span class="block text-[10px] font-black uppercase text-green-500 mb-2 tracking-widest">Direct Player Link (Auto-Approve)</span>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly value="{{ route('register.player') }}" class="flex-1 bg-zinc-800 border-none rounded-lg text-xs text-green-500 font-bold py-3 px-4 focus:ring-0">
                                <button onclick="copyToClipboard('{{ route('register.player') }}')" class="bg-green-500 text-black p-3 rounded-lg hover:bg-green-400 transition">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-gray-600 mt-2 italic font-bold uppercase tracking-tighter">* Send this to existing players for instant account setup.</p>
                        </div>
                    </div>
                </div>

                <!-- Content Management -->
                <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl flex items-center justify-between hover:border-green-500 transition cursor-pointer" onclick="window.location='{{ route('website.news.index') }}'">
                    <div>
                        <h3 class="font-black uppercase italic text-white">Latest News</h3>
                        <p class="text-xs text-gray-500 mt-1">Add, edit or delete academy news posts.</p>
                    </div>
                    <i class="fa-solid fa-newspaper text-3xl text-green-500 opacity-50"></i>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl flex items-center justify-between hover:border-green-500 transition cursor-pointer" onclick="window.location='{{ route('website.fixtures.index') }}'">
                    <div>
                        <h3 class="font-black uppercase italic text-white">Match Fixtures</h3>
                        <p class="text-xs text-gray-500 mt-1">Manage upcoming matches and results.</p>
                    </div>
                    <i class="fa-solid fa-calendar-days text-3xl text-green-500 opacity-50"></i>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl flex items-center justify-between hover:border-green-500 transition cursor-pointer md:col-span-2" onclick="window.location='{{ route('admin.payments.index') }}'">
                    <div>
                        <h3 class="font-black uppercase italic text-white">Donation Logs</h3>
                        <p class="text-xs text-gray-500 mt-1">Audit all incoming funds. Total Verified: <span class="text-green-500 font-bold">₦{{ number_format($totalRevenue, 2) }}</span></p>
                    </div>
                    <i class="fa-solid fa-file-invoice-dollar text-3xl text-green-500 opacity-50"></i>
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
                                @forelse($recentTrials as $trial)
                                <tr class="border-b border-zinc-800/50">
                                    <td class="py-4 font-bold">{{ $trial->name }}</td>
                                    <td class="py-4">{{ $trial->age }}</td>
                                    <td class="py-4">{{ $trial->position }}</td>
                                    <td class="py-4 italic">{{ $trial->trial_date ? \Carbon\Carbon::parse($trial->trial_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td class="py-4">
                                        @if($trial->status == 'pending')
                                            <span class="bg-yellow-500/10 text-yellow-500 px-2 py-1 rounded text-[10px] font-bold uppercase border border-yellow-500/20">Pending</span>
                                        @elseif($trial->status == 'approved')
                                            <span class="bg-green-500/10 text-green-500 px-2 py-1 rounded text-[10px] font-bold uppercase border border-green-500/20">Approved</span>
                                        @else
                                            <span class="bg-red-500/10 text-red-500 px-2 py-1 rounded text-[10px] font-bold uppercase border border-red-500/20">{{ $trial->status }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4">
                                        <a href="{{ route('admin.trials.index') }}" class="text-green-500 font-bold hover:underline">Manage</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500 italic">No trial registrations found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>