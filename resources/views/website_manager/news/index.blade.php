<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
                {{ __('Manage News') }}
            </h2>
            <a href="{{ route('website.news.create') }}" class="bg-green-500 text-black px-4 py-2 rounded font-black text-xs uppercase tracking-widest hover:bg-green-400 transition">
                Add News Post
            </a>
        </div>
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
                                    <th class="pb-3">Image</th>
                                    <th class="pb-3">Title</th>
                                    <th class="pb-3">Category</th>
                                    <th class="pb-3">Date</th>
                                    <th class="pb-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse($posts as $post)
                                <tr class="border-b border-zinc-800/50 hover:bg-white/5 transition">
                                    <td class="py-4">
                                        @if($post->featured_image)
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-12 h-12 rounded object-cover border border-zinc-700">
                                        @else
                                            <div class="w-12 h-12 rounded bg-zinc-800 flex items-center justify-center border border-zinc-700 text-zinc-600"><i class="fa-solid fa-image"></i></div>
                                        @endif
                                    </td>
                                    <td class="py-4 font-bold">{{ $post->title }}</td>
                                    <td class="py-4 text-green-500 font-bold text-[10px] uppercase tracking-widest">{{ $post->category }}</td>
                                    <td class="py-4 text-gray-500 text-xs">{{ $post->created_at->format('M d, Y') }}</td>
                                    <td class="py-4 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('website.news.edit', $post) }}" class="text-yellow-400 hover:text-yellow-300"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('website.news.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-gray-500 uppercase tracking-widest text-xs font-bold">No news posts found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
