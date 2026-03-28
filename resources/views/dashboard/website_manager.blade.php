<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Website Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-6 text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-2xl shadow-xl">
                        <h3 class="text-xs font-black uppercase tracking-widest text-green-500 mb-6 border-b border-zinc-800 pb-2">Manager Menu</h3>
                        <nav class="space-y-2">
                             <a href="#general" class="block px-4 py-3 rounded-xl bg-zinc-800 font-bold border-l-4 border-green-500">General Settings</a>
                             <a href="#slider" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Hero Slider</a>
                             <a href="#programs" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Manage Programs</a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Panels -->
                <div class="lg:col-span-2 space-y-12">
                    
                    <!-- General Settings Panel -->
                    <section id="general" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-gear text-green-500 mr-3"></i> Academy Details & Branding
                        </h3>
                        <form action="{{ route('website.settings.updateGeneral') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Academy Name</label>
                                    <x-text-input name="academy_name" value="{{ $settings->academy_name }}" class="w-full" required />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Logo</label>
                                    <input type="file" name="logo" class="text-xs text-gray-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Primary Color</label>
                                    <input type="color" name="primary_color" value="{{ $settings->primary_color }}" class="w-full h-10 bg-black border-zinc-800 rounded">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Secondary Color</label>
                                    <input type="color" name="secondary_color" value="{{ $settings->secondary_color }}" class="w-full h-10 bg-black border-zinc-800 rounded">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Phone</label>
                                    <x-text-input name="phone_number" value="{{ $settings->phone_number }}" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Email</label>
                                    <x-text-input name="email" value="{{ $settings->email }}" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Address</label>
                                    <x-text-input name="address" value="{{ $settings->address }}" class="w-full" />
                                </div>
                            </div>

                            <div class="pt-6">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Footer Text</label>
                                <x-text-input name="footer_text" value="{{ $settings->footer_text }}" class="w-full" />
                            </div>

                            <div class="pt-6">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">About Us Content</label>
                                <textarea name="about_us_content" rows="6" class="w-full bg-black border-zinc-800 rounded-lg text-sm text-white focus:ring-green-500 focus:border-green-500">{{ $settings->about_us_content }}</textarea>
                            </div>

                            <div class="flex justify-end pt-6 border-t border-zinc-800">
                                <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition">Update Settings</button>
                            </div>
                        </form>
                    </section>

                    <!-- Slider Panel -->
                    <section id="slider" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-images text-green-500 mr-3"></i> Home Hero Slider
                        </h3>
                        
                        <!-- Add New Slider -->
                        <form action="{{ route('website.settings.storeSlider') }}" method="POST" enctype="multipart/form-data" class="mb-10 p-6 bg-black rounded-xl border border-zinc-800">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Slider Image</label>
                                    <input type="file" name="image" required class="text-xs text-gray-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Heading</label>
                                    <x-text-input name="heading" class="w-full" placeholder="Main Title" />
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button type="submit" class="bg-zinc-800 text-white px-6 py-2 rounded-lg font-bold text-xs uppercase hover:bg-zinc-700 transition">Add Image to Slider</button>
                            </div>
                        </form>

                        <!-- List Sliders -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($sliders as $slider)
                            <div class="relative group rounded-lg overflow-hidden border border-zinc-800">
                                <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-32 object-cover opacity-60">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black/60">
                                    <form action="{{ route('website.settings.deleteSlider', $slider) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Academy Programs Panel -->
                    <section id="programs" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-trophy text-green-500 mr-3"></i> Academy Programs
                        </h3>
                        
                        <!-- Add New Program -->
                        <form action="{{ route('website.settings.storeProgram') }}" method="POST" enctype="multipart/form-data" class="mb-10 p-6 bg-black rounded-xl border border-zinc-800">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category Name</label>
                                    <x-text-input name="name" required class="w-full" placeholder="e.g. U10 Category" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Category Image</label>
                                    <input type="file" name="image" class="text-xs text-gray-400">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Short Description</label>
                                <textarea name="description" class="w-full bg-black border-zinc-800 rounded-lg text-sm text-white focus:ring-green-500 focus:border-green-500"></textarea>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button type="submit" class="bg-zinc-800 text-white px-6 py-2 rounded-lg font-bold text-xs uppercase hover:bg-zinc-700 transition">Add Program</button>
                            </div>
                        </form>

                        <!-- List Programs -->
                        <div class="space-y-4">
                            @foreach($programs as $program)
                            <div class="flex items-center justify-between p-4 bg-black border border-zinc-800 rounded-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-zinc-900 rounded overflow-hidden border border-zinc-800">
                                        @if($program->image)
                                            <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-zinc-700"><i class="fa-solid fa-image"></i></div>
                                        @endif
                                    </div>
                                    <span class="font-bold text-lg italic uppercase">{{ $program->name }}</span>
                                </div>
                                <form action="{{ route('website.settings.deleteProgram', $program) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 p-2"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
