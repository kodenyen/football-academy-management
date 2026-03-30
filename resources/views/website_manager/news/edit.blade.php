<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Edit News Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-600 text-white p-5 rounded-2xl mb-8 shadow-xl shadow-green-600/20 flex items-center font-black uppercase text-xs tracking-widest">
                    <i class="fa-solid fa-circle-check mr-3 text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl shadow-red-600/20 font-bold text-xs">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('website.news.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Title</label>
                        <x-text-input name="title" value="{{ $post->title }}" class="w-full" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category</label>
                            <select name="category" required class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                <option value="news" {{ $post->category == 'news' ? 'selected' : '' }}>News</option>
                                <option value="announcement" {{ $post->category == 'announcement' ? 'selected' : '' }}>Announcement</option>
                                <option value="match_report" {{ $post->category == 'match_report' ? 'selected' : '' }}>Match Report</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Featured Image (Leave blank to keep current)</label>
                            <input type="file" name="image" class="text-xs text-gray-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Content</label>
                        <textarea name="content" rows="10" required class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500">{{ $post->content }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-400 transition">Update News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
