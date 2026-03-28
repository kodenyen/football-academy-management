<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Player Profile Card -->
                <div class="col-span-1 md:col-span-1">
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl text-center shadow-sm">
                        <div class="relative inline-block mx-auto mb-6">
                            <div class="w-32 h-32 bg-zinc-800 rounded-full flex items-center justify-center border-4 border-green-500 mx-auto">
                                <i class="fa-solid fa-user text-5xl text-gray-600"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black uppercase italic">{{ Auth::user()->name }}</h3>
                        <p class="text-green-500 font-bold uppercase tracking-widest text-sm">Forward | U15</p>
                        
                        <div class="grid grid-cols-2 gap-4 mt-8 border-t border-zinc-800 pt-8">
                            <div>
                                <span class="block text-gray-500 text-xs uppercase font-bold">Age</span>
                                <span class="font-black text-xl">15</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 text-xs uppercase font-bold">Foot</span>
                                <span class="font-black text-xl">Left</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats & Reports -->
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <!-- Performance Stats -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-black mb-6 uppercase italic flex items-center">
                            <i class="fa-solid fa-bolt text-green-500 mr-3"></i> Performance Stats
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">Speed</span>
                                    <span class="text-xs font-black text-green-500">90%</span>
                                </div>
                                <div class="w-full bg-zinc-800 h-2 rounded-full">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">Dribbling</span>
                                    <span class="text-xs font-black text-green-500">85%</span>
                                </div>
                                <div class="w-full bg-zinc-800 h-2 rounded-full">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">Shooting</span>
                                    <span class="text-xs font-black text-green-500">80%</span>
                                </div>
                                <div class="w-full bg-zinc-800 h-2 rounded-full">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 80%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">Passing</span>
                                    <span class="text-xs font-black text-green-500">75%</span>
                                </div>
                                <div class="w-full bg-zinc-800 h-2 rounded-full">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Preview -->
                    <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-black mb-6 uppercase italic">Attendance Tracking</h3>
                        <div class="flex space-x-2">
                             @for($i=0; $i<10; $i++)
                                <div class="w-8 h-8 rounded-md bg-green-500/20 border border-green-500/50 flex items-center justify-center text-green-500 text-[10px] font-bold">P</div>
                             @endfor
                             <div class="w-8 h-8 rounded-md bg-red-500/20 border border-red-500/50 flex items-center justify-center text-red-500 text-[10px] font-bold">A</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
