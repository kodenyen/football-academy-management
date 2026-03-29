<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Manage Trial Registrations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6 text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-zinc-800 text-gray-500 text-xs uppercase tracking-widest">
                                    <th class="pb-3">Player Info</th>
                                    <th class="pb-3">Trial Date</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($registrations as $reg)
                                <tr class="border-b border-zinc-800/50 hover:bg-white/5 transition">
                                    <td class="py-4">
                                        <span class="block font-bold text-base">{{ $reg->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $reg->position }} | {{ $reg->age }} yrs</span><br>
                                        <span class="text-xs text-green-500">{{ $reg->contact_number }}</span>
                                    </td>
                                    <td class="py-4 font-mono">{{ \Carbon\Carbon::parse($reg->trial_date)->format('M d, Y') }}</td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-black uppercase {{ $reg->status == 'approved' ? 'bg-green-500/20 text-green-500' : ($reg->status == 'rejected' ? 'bg-red-500/20 text-red-500' : 'bg-yellow-500/20 text-yellow-500') }}">
                                            {{ $reg->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-right">
                                        <form action="{{ route('admin.trials.update', $reg) }}" method="POST" class="inline-flex space-x-2">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="bg-green-500/10 text-green-500 border border-green-500/30 px-3 py-1 rounded text-[10px] font-bold uppercase hover:bg-green-500 hover:text-black transition">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.trials.update', $reg) }}" method="POST" class="inline-flex">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-500/10 text-red-500 border border-red-500/30 px-3 py-1 rounded text-[10px] font-bold uppercase hover:bg-red-500 hover:text-black transition">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @if($reg->custom_fields)
                                <tr>
                                    <td colspan="4" class="pb-4 pt-0 px-4">
                                        <div class="bg-black/30 p-3 rounded-lg text-[10px] text-gray-400 grid grid-cols-2 md:grid-cols-4 gap-4 italic">
                                            @foreach($reg->custom_fields as $key => $val)
                                                <div><span class="font-bold text-gray-500 uppercase">{{ str_replace('_', ' ', $key) }}:</span> {{ $val }}</div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-500 uppercase tracking-widest text-xs font-bold">No trial registrations found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $registrations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
