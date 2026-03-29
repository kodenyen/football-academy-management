<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Create News Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('website.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Title</label>
                        <x-text-input name="title" class="w-full" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category</label>
                            <select name="category" required class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                <option value="news">News</option>
                                <option value="announcement">Announcement</option>
                                <option value="match_report">Match Report</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Featured Image</label>
                            <input type="file" name="image" class="text-xs text-gray-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Content</label>
                        <textarea name="content" rows="10" required class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition">Publish News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
