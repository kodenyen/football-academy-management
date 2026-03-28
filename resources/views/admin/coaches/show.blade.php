<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
                {{ __('Coach Profile') }}
            </h2>
            <a href="{{ route('admin.coaches.index') }}" class="text-gray-400 hover:text-white text-xs uppercase font-black">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="md:col-span-1">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 text-center shadow-lg">
                        <div class="w-32 h-32 mx-auto mb-6 rounded-full border-4 border-green-500 overflow-hidden bg-black">
                            @if($coach->photo)
                                <img src="{{ asset('storage/' . $coach->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fa-solid fa-user text-5xl text-zinc-800"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-2xl font-black uppercase italic text-white">{{ $coach->user->name }}</h3>
                        <p class="text-green-500 font-bold uppercase text-xs tracking-widest mt-1">{{ $coach->specialization ?? 'Coach' }}</p>
                        
                        <div class="mt-8 space-y-4 border-t border-zinc-800 pt-8 text-left">
                            <div class="flex justify-between items-center">
                                <span class="text-xs uppercase font-black text-gray-500">Email</span>
                                <span class="text-sm font-bold">{{ $coach->user->email }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs uppercase font-black text-gray-500">Phone</span>
                                <span class="text-sm font-bold">{{ $coach->phone ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs uppercase font-black text-gray-500">License</span>
                                <span class="text-sm font-bold text-blue-400">{{ $coach->certification ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mt-8">
                             <a href="{{ route('admin.coaches.edit', $coach) }}" class="block w-full bg-zinc-800 text-white py-3 rounded-xl font-bold hover:bg-zinc-700 transition">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="md:col-span-2 space-y-8">
                    <!-- Bio/Experience -->
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-lg font-black uppercase italic text-green-500 mb-6">Background & Experience</h3>
                        <p class="text-gray-300 leading-relaxed italic">
                            {{ $coach->experience ?: 'No experience details provided yet.' }}
                        </p>
                    </div>

                    <!-- Performance / Stats (Placeholder) -->
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-lg font-black uppercase italic text-green-500 mb-6">Performance & Fixtures</h3>
                        <div class="text-center py-10">
                             <i class="fa-solid fa-chart-line text-4xl text-zinc-800 mb-4"></i>
                             <p class="text-gray-500 text-sm uppercase font-bold tracking-widest">Historical Performance Data will appear here as matches are played.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
