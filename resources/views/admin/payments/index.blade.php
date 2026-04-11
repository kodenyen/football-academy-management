<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Financial Audit: Donations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-white uppercase italic">Transaction Logs</h3>
                            <p class="text-gray-500 text-xs mt-1 uppercase tracking-widest">Real-time donation flow monitoring</p>
                        </div>
                        <div class="bg-black/40 px-6 py-3 rounded-xl border border-zinc-800">
                            <span class="text-gray-500 text-[10px] font-black uppercase block mb-1">Total Revenue</span>
                            <span class="text-xl font-black text-green-500 italic">₦{{ number_format(\App\Models\Payment::where('status', 'success')->sum('amount'), 2) }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-zinc-800 text-gray-500 text-[10px] font-black uppercase tracking-[0.2em]">
                                    <th class="pb-4">Reference / Date</th>
                                    <th class="pb-4">Donor Details</th>
                                    <th class="pb-4">Campaign</th>
                                    <th class="pb-4">Amount</th>
                                    <th class="pb-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800/50">
                                @forelse($payments as $payment)
                                <tr class="group hover:bg-black/20 transition">
                                    <td class="py-6">
                                        <span class="block font-black text-white text-xs">{{ $payment->reference }}</span>
                                        <span class="text-[10px] text-gray-600 font-bold uppercase">{{ $payment->created_at->format('M d, Y @ H:i') }}</span>
                                    </td>
                                    <td class="py-6">
                                        <span class="block font-bold text-gray-300 text-sm italic">{{ $payment->email }}</span>
                                        <span class="text-[9px] text-gray-600 uppercase font-black tracking-widest">{{ $payment->user ? $payment->user->name : 'Guest Donor' }}</span>
                                    </td>
                                    <td class="py-6">
                                        @if($payment->campaign)
                                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-[9px] font-black uppercase rounded-full border border-blue-500/20">{{ $payment->campaign->title }}</span>
                                        @else
                                            <span class="text-[9px] text-gray-600 font-black uppercase italic">General Fund</span>
                                        @endif
                                    </td>
                                    <td class="py-6">
                                        <span class="text-lg font-black {{ $payment->status === 'success' ? 'text-green-500' : 'text-gray-500' }}">₦{{ number_format($payment->amount, 2) }}</span>
                                    </td>
                                    <td class="py-6">
                                        @if($payment->status === 'success')
                                            <span class="bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-[9px] font-black uppercase border border-green-500/20">Verified</span>
                                        @elseif($payment->status === 'pending')
                                            <span class="bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full text-[9px] font-black uppercase border border-yellow-500/20">Pending</span>
                                        @else
                                            <span class="bg-red-500/10 text-red-500 px-3 py-1 rounded-full text-[9px] font-black uppercase border border-red-500/20">{{ $payment->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <div class="w-16 h-16 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fa-solid fa-receipt text-2xl text-zinc-700"></i>
                                        </div>
                                        <p class="text-gray-500 text-xs font-black uppercase tracking-widest">No transaction records found.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
