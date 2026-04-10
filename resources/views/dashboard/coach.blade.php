<x-app-layout>
    <x-slot name="header">
        {{ __('Coach Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Left Column: Actions & Fixtures -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <div class="flex items-center justify-between mb-8 pb-4 border-b border-zinc-800">
                            <h3 class="text-2xl font-black uppercase italic text-white flex items-center">
                                <i class="fa-solid fa-gauge-high text-green-500 mr-3"></i> Training Ops
                            </h3>
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest bg-zinc-800 px-3 py-1 rounded-full">Active Session</span>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <a href="{{ route('coach.attendance.index') }}" class="group bg-zinc-800/50 border border-zinc-700/50 p-6 rounded-2xl hover:bg-green-500 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-zinc-900 rounded-xl flex items-center justify-center mb-4 group-hover:bg-black/20">
                                    <i class="fa-solid fa-clipboard-user text-green-500 text-xl group-hover:text-black"></i>
                                </div>
                                <span class="block font-black uppercase text-xs tracking-widest text-gray-400 group-hover:text-black mb-1">Attendance</span>
                                <span class="block font-black text-xl text-white group-hover:text-black italic">Mark Training</span>
                            </a>
                            
                            <a href="{{ route('coach.reports.create') }}" class="group bg-zinc-800/50 border border-zinc-700/50 p-6 rounded-2xl hover:bg-green-500 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-zinc-900 rounded-xl flex items-center justify-center mb-4 group-hover:bg-black/20">
                                    <i class="fa-solid fa-chart-line text-green-500 text-xl group-hover:text-black"></i>
                                </div>
                                <span class="block font-black uppercase text-xs tracking-widest text-gray-400 group-hover:text-black mb-1">Performance</span>
                                <span class="block font-black text-xl text-white group-hover:text-black italic">Post Report</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Reports List -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black mb-6 uppercase italic text-white flex items-center">
                            <i class="fa-solid fa-history text-green-500 mr-3"></i> Recent Evaluations
                        </h3>
                        <div class="space-y-4">
                            @forelse($recentReports as $report)
                            <div class="bg-black/40 border border-zinc-800 p-4 rounded-xl flex items-center justify-between hover:border-green-500/50 transition">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center font-black text-xs text-green-500 border border-green-500/20">
                                        {{ $report->rating }}
                                    </div>
                                    <div>
                                        <span class="block font-bold text-white uppercase text-sm italic">{{ $report->player->user->name }}</span>
                                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-black">{{ \Carbon\Carbon::parse($report->date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] font-black uppercase text-green-500">Overall Success</span>
                                    <div class="flex space-x-0.5 mt-1">
                                        @for($i=1; $i<=10; $i++)
                                            <div class="w-1.5 h-3 rounded-full {{ $i <= $report->rating ? 'bg-green-500' : 'bg-zinc-800' }}"></div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500 text-xs italic">No recent reports submitted.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Fixtures & Stats -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Upcoming Fixtures -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black mb-6 uppercase italic text-white flex items-center">
                            <i class="fa-solid fa-calendar-day text-green-500 mr-3"></i> Match Schedule
                        </h3>
                        <div class="space-y-4">
                            @forelse($fixtures as $fixture)
                            <div class="bg-black/40 border-l-4 border-green-500 p-4 rounded-r-xl">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-[10px] font-black uppercase text-green-500 bg-green-500/10 px-2 py-0.5 rounded">{{ $fixture->status }}</span>
                                    <span class="text-[10px] text-gray-500 font-bold uppercase">{{ \Carbon\Carbon::parse($fixture->match_date)->format('H:i') }}</span>
                                </div>
                                <span class="block font-black text-white uppercase italic text-sm mb-1">{{ $fixture->team_category }} VS {{ $fixture->opponent }}</span>
                                <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($fixture->match_date)->format('M d, Y') }}</span>
                            </div>
                            @empty
                            <p class="text-gray-500 text-xs italic">No upcoming matches.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Mini Stat Card -->
                    <div class="bg-green-500 p-8 rounded-2xl shadow-xl shadow-green-500/10">
                        <div class="flex justify-between items-start mb-4">
                            <i class="fa-solid fa-users-viewfinder text-black text-3xl"></i>
                            <span class="bg-black text-white text-[8px] font-black uppercase px-2 py-1 rounded">Live Data</span>
                        </div>
                        <h4 class="text-black font-black uppercase text-xs tracking-widest mb-1">Squad Pulse</h4>
                        <p class="text-3xl font-black italic text-black mb-4">{{ \App\Models\Player::count() }} ACTIVE PLAYERS</p>
                        <div class="w-full bg-black/10 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-black h-full w-3/4 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
