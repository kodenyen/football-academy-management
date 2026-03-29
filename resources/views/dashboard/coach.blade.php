<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coach Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Quick Actions -->
                <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl shadow-sm">
                    <h3 class="text-xl font-black mb-4 uppercase italic">Training Management</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('coach.attendance.index') }}" class="bg-zinc-800 border border-zinc-700 p-4 rounded-lg text-center hover:bg-green-500 hover:text-black transition">
                            <i class="fa-solid fa-clipboard-user text-2xl mb-2"></i>
                            <span class="block font-bold">Mark Attendance</span>
                        </a>
                        <a href="{{ route('coach.reports.create') }}" class="bg-zinc-800 border border-zinc-700 p-4 rounded-lg text-center hover:bg-green-500 hover:text-black transition">
                            <i class="fa-solid fa-chart-line text-2xl mb-2"></i>
                            <span class="block font-bold">Post Performance Report</span>
                        </a>
                    </div>
                </div>
                
                <!-- Match List -->
                <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-xl shadow-sm">
                    <h3 class="text-xl font-black mb-4 uppercase italic">My Team Fixtures</h3>
                    <div class="space-y-4">
                        <div class="bg-black border border-zinc-800 p-4 rounded-lg flex items-center justify-between">
                            <div>
                                <span class="block font-bold">TRFA U15 vs City Stars</span>
                                <span class="text-xs text-gray-500">Tomorrow at 10:00 AM</span>
                            </div>
                            <span class="bg-green-500 text-black px-2 py-1 rounded text-[10px] font-bold uppercase">Scheduled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
