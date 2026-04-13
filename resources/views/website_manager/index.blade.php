<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Website Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-zinc-900 border border-zinc-800 p-6 rounded-2xl shadow-xl">
                        <h3 class="text-xs font-black uppercase tracking-widest text-green-500 mb-6 border-b border-zinc-800 pb-2">Manager Menu</h3>
                        <nav class="space-y-2">
                             <a href="#branding" class="block px-4 py-3 rounded-xl bg-zinc-800 font-bold border-l-4 border-green-500">Branding</a>
                             <a href="#contact" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Contact Info</a>
                             <a href="#content" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Site Content</a>
                             <a href="#about-page" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold text-green-500">Manage About Page</a>
                             <a href="#showcase-mgmt" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold text-red-500">Showcase Videos</a>
                             <a href="#slider" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Hero Slider</a>
                             <a href="#programs" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Manage Programs</a>
                             <a href="#campaigns" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold text-yellow-500">Funding Campaigns</a>
                             <a href="#gallery-mgmt" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold text-blue-500">Manage Gallery</a>
                             <a href="#paystack" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Paystack Settings</a>
                             <a href="#smtp" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">SMTP Settings</a>
                             <a href="#form-builder" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Form Builder</a>
                             <div class="pt-4 border-t border-zinc-800 mt-4">
                                <span class="text-[10px] font-black uppercase text-gray-600 px-4">Content CRUD</span>
                                <a href="{{ route('website.news.index') }}" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Manage News</a>
                                <a href="{{ route('website.fixtures.index') }}" class="block px-4 py-3 rounded-xl hover:bg-zinc-800 transition font-bold">Manage Fixtures</a>
                             </div>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Panels -->
                <div class="lg:col-span-2 space-y-12">
                    
                    <!-- Branding Settings -->
                    <section id="branding" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-palette text-green-500 mr-3"></i> Branding & Identity
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
                                    <input type="color" name="primary_color" value="{{ $settings->primary_color }}" class="w-full h-10 bg-white border-zinc-300 rounded">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Secondary Color</label>
                                    <input type="color" name="secondary_color" value="{{ $settings->secondary_color }}" class="w-full h-10 bg-white border-zinc-300 rounded">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Background Color</label>
                                    <input type="color" name="background_color" value="{{ $settings->background_color ?? '#18181b' }}" class="w-full h-10 bg-white border-zinc-300 rounded">
                                </div>
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-green-500 text-black px-6 py-2 rounded-lg font-black uppercase text-xs tracking-widest hover:bg-green-400 transition">Save Branding</button>
                            </div>
                        </form>
                    </section>

                    <!-- Contact Details Settings -->
                    <section id="contact" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-address-book text-green-500 mr-3"></i> Contact Information
                        </h3>
                        <form action="{{ route('website.settings.updateGeneral') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Office Phone</label>
                                    <x-text-input name="phone_number" value="{{ $settings->phone_number }}" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">WhatsApp Number</label>
                                    <x-text-input name="whatsapp_number" value="{{ $settings->whatsapp_number }}" class="w-full" placeholder="+234..." />
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
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-green-500 text-black px-6 py-2 rounded-lg font-black uppercase text-xs tracking-widest hover:bg-green-400 transition">Save Contact Info</button>
                            </div>
                        </form>
                    </section>

                    <!-- Site Content Settings -->
                    <section id="content" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-file-lines text-green-500 mr-3"></i> Page Content & Footer
                        </h3>
                        <form action="{{ route('website.settings.updateGeneral') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Footer Text</label>
                                <x-text-input name="footer_text" value="{{ $settings->footer_text }}" class="w-full" />
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-green-500 text-black px-6 py-2 rounded-lg font-black uppercase text-xs tracking-widest hover:bg-green-400 transition">Save Footer</button>
                            </div>
                        </form>
                    </section>

                    <!-- About Page Management Panel -->
                    <section id="about-page" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl" x-data="{ editFacility: null }">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-circle-info text-green-500 mr-3"></i> Manage About Page
                        </h3>
                        
                        <form action="{{ route('website.settings.updateAbout') }}" method="POST" class="space-y-6 border-b border-zinc-800 pb-10 mb-10">
                            @csrf
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Main About Us Content</label>
                                <textarea name="about_us_content" rows="4" class="w-full bg-white border-zinc-300 text-black rounded-lg text-sm">{{ $settings->about_us_content }}</textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Our Vision</label>
                                    <textarea name="about_vision" rows="3" class="w-full bg-white border-zinc-300 text-black rounded-lg text-sm">{{ $settings->about_vision }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Our Mission</label>
                                    <textarea name="about_mission" rows="3" class="w-full bg-white border-zinc-300 text-black rounded-lg text-sm">{{ $settings->about_mission }}</textarea>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Side Video YouTube ID (e.g. dQw4w9WgXcQ)</label>
                                <x-text-input name="about_video_id" value="{{ $settings->about_video_id }}" class="w-full" />
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-500 text-black px-8 py-2 rounded-lg font-black uppercase text-xs tracking-widest hover:bg-green-400 transition">Update About Content</button>
                            </div>
                        </form>

                        <!-- Facilities Management -->
                        <div class="space-y-6">
                            <h4 class="text-sm font-black uppercase tracking-widest text-green-500">Manage Facilities</h4>
                            
                            <!-- Add Facility -->
                            <form action="{{ route('website.settings.storeFacility') }}" method="POST" enctype="multipart/form-data" class="p-6 bg-black rounded-xl border border-zinc-800 space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <x-text-input name="name" placeholder="Facility Name" class="w-full text-xs" required />
                                    <input type="file" name="image" class="text-xs text-gray-400">
                                </div>
                                <textarea name="description" placeholder="Short Description" class="w-full bg-white text-black border-zinc-300 rounded text-xs"></textarea>
                                <button type="submit" class="w-full bg-zinc-800 text-white py-2 rounded font-bold text-[10px] uppercase">Add Facility</button>
                            </form>

                            <!-- List Facilities -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($facilities as $facility)
                                <div class="flex items-center justify-between p-4 bg-zinc-800 rounded-xl border border-zinc-700">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-zinc-900 rounded overflow-hidden">
                                            @if($facility->image)
                                                <img src="{{ asset('storage/' . $facility->image) }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <span class="text-xs font-bold uppercase italic text-white">{{ $facility->name }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button type="button" @click="editFacility = @js($facility)" class="text-blue-500 hover:text-blue-400 p-2 transition"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <form action="{{ route('website.settings.deleteFacility', $facility) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 p-2 transition"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach

                                <!-- Edit Facility Modal -->
                                <template x-if="editFacility">
                                    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">
                                        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl" @click.away="editFacility = null">
                                            <div class="flex justify-between items-center mb-8">
                                                <h4 class="text-2xl font-black uppercase italic text-white tracking-tighter">Edit Facility</h4>
                                                <button type="button" @click="editFacility = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                                            </div>
                                            
                                            <form :action="'{{ route('website.settings.updateFacility', ['facility' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editFacility.id)" method="POST" enctype="multipart/form-data" class="space-y-6">
                                                @csrf @method('PUT')
                                                <div>
                                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Facility Name</label>
                                                    <x-text-input name="name" x-model="editFacility.name" required class="w-full" />
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Change Image (Optional)</label>
                                                    <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700">
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Description</label>
                                                    <textarea name="description" x-model="editFacility.description" class="w-full bg-white border-zinc-300 text-black rounded-xl focus:ring-green-500 focus:border-green-500 h-32 text-sm"></textarea>
                                                </div>
                                                <div class="flex justify-end space-x-4 pt-4">
                                                    <button type="button" @click="editFacility = null" class="text-zinc-500 text-xs font-bold uppercase hover:text-white transition">Cancel</button>
                                                    <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-green-400 transition shadow-lg shadow-green-500/20">Update Facility</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </section>

                    <!-- Slider Panel -->
                    <section id="slider" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl" x-data="{ editSlider: null }">
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
                            <div class="relative group rounded-lg overflow-hidden border border-zinc-800 bg-black aspect-video">
                                <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition duration-500">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black/40 space-x-3">
                                    <button type="button" @click="editSlider = @js($slider)" class="bg-blue-600 text-white p-2.5 rounded-full hover:scale-110 transition shadow-lg"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('website.settings.deleteSlider', $slider) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white p-2.5 rounded-full hover:scale-110 transition shadow-lg"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-2 bg-black/60 backdrop-blur-sm">
                                    <p class="text-[10px] font-bold text-white truncate text-center uppercase">{{ $slider->heading }}</p>
                                </div>
                            </div>
                            @endforeach

                            <!-- Edit Slider Modal -->
                            <div x-show="editSlider" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">
                                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl" @click.away="editSlider = null">
                                    <div class="flex justify-between items-center mb-8">
                                        <h4 class="text-2xl font-black uppercase italic text-white tracking-tighter">Edit Slider</h4>
                                        <button type="button" @click="editSlider = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                                    </div>
                                    
                                    <form x-bind:action="'{{ route('website.settings.updateSlider', ['slider' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editSlider ? editSlider.id : '')" method="POST" enctype="multipart/form-data" class="space-y-6">
                                        @csrf @method('PUT')
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Heading</label>
                                            <x-text-input name="heading" x-model="editSlider ? editSlider.heading : ''" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Sub Heading</label>
                                            <x-text-input name="sub_heading" x-model="editSlider ? editSlider.sub_heading : ''" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Change Image (Optional)</label>
                                            <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700">
                                        </div>
                                        <div class="flex justify-end space-x-4 pt-4">
                                            <button type="button" @click="editSlider = null" class="text-zinc-500 text-xs font-bold uppercase hover:text-white transition">Cancel</button>
                                            <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-green-400 transition shadow-lg shadow-green-500/20">Update Slider</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Academy Programs Panel -->
                    <section id="programs" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl" x-data="{ editProgram: null }">
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
                                <textarea name="description" class="w-full bg-white border-zinc-300 text-black focus:ring-green-500 focus:border-green-500 rounded-lg"></textarea>
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
                                    <div>
                                        <span class="font-bold text-lg italic uppercase block text-white">{{ $program->name }}</span>
                                        <p class="text-[10px] text-zinc-500 line-clamp-1">{{ $program->description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button type="button" @click="editProgram = @js($program)" class="flex items-center space-x-2 bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg transition border border-blue-500/20">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Edit</span>
                                    </button>
                                    <form action="{{ route('website.settings.deleteProgram', $program) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="flex items-center space-x-2 bg-red-600/10 text-red-500 hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg transition border border-red-500/20">
                                            <i class="fa-solid fa-trash"></i>
                                            <span class="text-[10px] font-black uppercase tracking-widest">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            <!-- Edit Modal -->
                            <div x-show="editProgram" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">
                                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl" @click.away="editProgram = null">
                                    <div class="flex justify-between items-center mb-8">
                                        <h4 class="text-2xl font-black uppercase italic text-white tracking-tighter">Edit Program</h4>
                                        <button type="button" @click="editProgram = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                                    </div>
                                    
                                    <form x-bind:action="'{{ route('website.settings.updateProgram', ['program' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editProgram ? editProgram.id : '')" method="POST" enctype="multipart/form-data" class="space-y-6">
                                        @csrf @method('PUT')
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Category Name</label>
                                            <x-text-input name="name" x-model="editProgram ? editProgram.name : ''" required class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Change Image (Optional)</label>
                                            <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Description</label>
                                            <textarea name="description" x-model="editProgram ? editProgram.description : ''" class="w-full bg-white border-zinc-300 text-black rounded-xl focus:ring-green-500 focus:border-green-500 h-32 text-sm"></textarea>
                                        </div>
                                        <div class="flex justify-end space-x-4 pt-4">
                                            <button type="button" @click="editProgram = null" class="text-zinc-500 text-xs font-bold uppercase hover:text-white transition">Cancel</button>
                                            <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-green-400 transition shadow-lg shadow-green-500/20">Update Program</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Gallery Management Panel -->
                    <section id="gallery-mgmt" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-camera text-blue-500 mr-3"></i> Media Gallery
                        </h3>
                        
                        <!-- Add to Gallery -->
                        <form action="{{ route('website.gallery.store') }}" method="POST" enctype="multipart/form-data" class="mb-10 p-6 bg-black rounded-xl border border-zinc-800">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Image Title (Optional)</label>
                                    <x-text-input name="title" class="w-full" placeholder="e.g. Training Session" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Select Image</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="file" name="file" required class="text-xs text-gray-400">
                                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold text-xs uppercase hover:bg-blue-500 transition whitespace-nowrap">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- List Gallery Items -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($gallery as $item)
                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-zinc-800 bg-black">
                                <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition duration-500">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black/40">
                                    <form action="{{ route('website.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Remove this image?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                                @if($item->title)
                                <div class="absolute bottom-0 left-0 right-0 p-2 bg-black/60 backdrop-blur-sm">
                                    <p class="text-[9px] font-black uppercase text-white truncate text-center">{{ $item->title }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Paystack Panel -->
                    <section id="paystack" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-credit-card text-green-500 mr-3"></i> Paystack Gateway Settings
                        </h3>
                        <form action="{{ route('website.settings.updatePayment') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Paystack Public Key</label>
                                    <x-text-input name="paystack_public_key" value="{{ $settings->paystack_public_key }}" class="w-full font-mono text-xs" placeholder="pk_test_..." />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Paystack Secret Key</label>
                                    <x-text-input type="password" name="paystack_secret_key" value="{{ $settings->paystack_secret_key }}" class="w-full font-mono text-xs" placeholder="sk_test_..." />
                                </div>
                            </div>
                            <div class="flex justify-end pt-6 border-t border-zinc-800">
                                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-blue-400 transition">Save Keys</button>
                            </div>
                        </form>
                    </section>

                    <!-- SMTP Panel -->
                    <section id="smtp" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-envelope text-green-500 mr-3"></i> SMTP Email Settings
                        </h3>
                        <form action="{{ route('website.settings.updateMail') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Mail Host</label>
                                    <x-text-input name="mail_host" value="{{ $settings->mail_host }}" class="w-full" placeholder="smtp.mailtrap.io" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Mail Port</label>
                                    <x-text-input name="mail_port" value="{{ $settings->mail_port }}" class="w-full" placeholder="587" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Mail Username</label>
                                    <x-text-input name="mail_username" value="{{ $settings->mail_username }}" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Mail Password</label>
                                    <x-text-input type="password" name="mail_password" value="{{ $settings->mail_password }}" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Mail Encryption</label>
                                    <select name="mail_encryption" class="w-full bg-white text-black border-zinc-300 rounded-lg">
                                        <option value="tls" {{ $settings->mail_encryption == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ $settings->mail_encryption == 'ssl' ? 'selected' : '' }}>SSL</option>
                                        <option value="" {{ !$settings->mail_encryption ? 'selected' : '' }}>None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-zinc-800">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">From Address</label>
                                    <x-text-input name="mail_from_address" value="{{ $settings->mail_from_address }}" class="w-full" placeholder="noreply@academy.com" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">From Name</label>
                                    <x-text-input name="mail_from_name" value="{{ $settings->mail_from_name }}" class="w-full" placeholder="Academy Notifications" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-6">
                                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-blue-400 transition">Save SMTP Settings</button>
                            </div>
                        </form>
                    </section>

                    <!-- Showcase Videos -->
                    <section id="showcase-mgmt" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl" x-data="{ editShowcase: null }">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-xl font-black uppercase italic text-white flex items-center">
                                <i class="fa-solid fa-clapperboard text-green-500 mr-3"></i> Talent Showcase Videos
                            </h3>
                        </div>

                        <form action="{{ route('website.settings.storeShowcase') }}" method="POST" class="bg-black/40 p-8 rounded-2xl border border-zinc-800 mb-12 space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Highlight Title / Player Name</label>
                                    <x-text-input name="title" class="w-full" required placeholder="e.g. John Doe Highlight Reel" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Player Position (Optional)</label>
                                    <x-text-input name="position" class="w-full" placeholder="e.g. Center Forward" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">YouTube URL</label>
                                    <x-text-input name="youtube_url" class="w-full" required placeholder="https://www.youtube.com/watch?v=..." />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Link to Student Profile (Optional)</label>
                                    <select name="player_id" class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500 font-bold">
                                        <option value="">No Link (Team/Generic Video)</option>
                                        @foreach($players as $player)
                                            <option value="{{ $player->id }}">{{ $player->user->name }} ({{ $player->position }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end pt-6 border-t border-zinc-800">
                                <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition shadow-lg shadow-green-500/20">Add Video to Showcase</button>
                            </div>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            @foreach($showcaseVideos as $video)
                            <div class="bg-black border border-zinc-800 rounded-2xl overflow-hidden hover:border-green-500/50 transition group">
                                <div class="aspect-video bg-zinc-800 relative">
                                    <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fa-solid fa-play text-white text-3xl opacity-50 group-hover:scale-125 transition"></i>
                                    </div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-2 py-1 rounded bg-black/80 text-[8px] font-black uppercase text-white">{{ $video->is_active ? 'Public' : 'Hidden' }}</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-white font-black uppercase italic text-sm mb-1 truncate">{{ $video->title }}</h4>
                                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-4">{{ $video->position ?? 'Academy Feature' }}</p>
                                    
                                    <div class="flex items-center space-x-4 pt-4 border-t border-zinc-800">
                                        <button type="button" @click="editShowcase = @js($video)" class="text-[10px] font-black uppercase text-blue-500 hover:text-blue-400 transition">Edit</button>
                                        <form action="{{ route('website.settings.deleteShowcase', $video) }}" method="POST" onsubmit="return confirm('Remove this video?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-[10px] font-black uppercase text-red-500 hover:text-red-400 transition">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Edit Video Modal -->
                        <div x-show="editShowcase" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">
                            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl" @click.away="editShowcase = null">
                                <div class="flex justify-between items-center mb-8">
                                    <h4 class="text-2xl font-black uppercase italic text-white tracking-tighter">Edit Highlight</h4>
                                    <button type="button" @click="editShowcase = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                                </div>
                                
                                <form x-bind:action="'{{ route('website.settings.updateShowcase', ['showcase' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editShowcase ? editShowcase.id : '')" method="POST" class="space-y-6">
                                    @csrf @method('PUT')
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Title</label>
                                        <x-text-input name="title" x-model="editShowcase ? editShowcase.title : ''" required class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">YouTube URL</label>
                                        <x-text-input name="youtube_url" x-model="editShowcase ? editShowcase.youtube_url : ''" required class="w-full" />
                                    </div>
                                    <div class="grid grid-cols-2 gap-6">
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <div class="relative">
                                                <input type="checkbox" name="is_active" value="1" :checked="editShowcase ? editShowcase.is_active : false" class="sr-only peer">
                                                <div class="w-10 h-6 bg-zinc-700 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-4"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-gray-400 group-hover:text-white transition uppercase tracking-widest">Show Publicly</span>
                                        </label>
                                    </div>
                                    <div class="flex justify-end space-x-4 pt-4">
                                        <button type="button" @click="editShowcase = null" class="text-zinc-500 text-xs font-bold uppercase hover:text-white transition">Cancel</button>
                                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-green-400 transition">Update Highlight</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Funding Campaigns -->
                    <section id="campaigns" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl" x-data="{ editCampaign: null }">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-hand-holding-dollar text-green-500 mr-3"></i> Funding Campaigns
                        </h3>

                        <form action="{{ route('website.settings.storeCampaign') }}" method="POST" enctype="multipart/form-data" class="bg-black/40 p-8 rounded-2xl border border-zinc-800 mb-12 space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Campaign Title</label>
                                    <x-text-input name="title" class="w-full" required placeholder="e.g. New Equipment Fund" />
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Target Amount (NGN)</label>
                                    <x-text-input type="number" name="target_amount" class="w-full" placeholder="e.g. 500000" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Campaign Description</label>
                                <textarea name="description" rows="3" class="w-full bg-white text-black border-zinc-300 rounded-lg focus:ring-green-500" placeholder="Explain the purpose of this fund..."></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Campaign Image</label>
                                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700">
                                </div>
                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <div class="relative">
                                            <input type="checkbox" name="show_progress" value="1" checked class="sr-only peer">
                                            <div class="w-10 h-6 bg-zinc-700 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-4"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-400 group-hover:text-white transition uppercase tracking-widest">Show Progress Meter</span>
                                    </label>
                                </div>
                            </div>
                            <div class="flex justify-end pt-6 border-t border-zinc-800">
                                <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition">Create Campaign</button>
                            </div>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($campaigns as $campaign)
                            <div class="bg-black border border-zinc-800 rounded-2xl overflow-hidden hover:border-green-500/50 transition duration-500 group">
                                <div class="h-48 bg-zinc-800 relative">
                                    @if($campaign->image)
                                        <img src="{{ asset('storage/' . $campaign->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-4xl text-zinc-700"><i class="fa-solid fa-image"></i></div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                                        <h4 class="text-xl font-black uppercase italic text-white">{{ $campaign->title }}</h4>
                                    </div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $campaign->is_active ? 'bg-green-500 text-black' : 'bg-red-500 text-white' }}">
                                            {{ $campaign->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8 space-y-6">
                                    <p class="text-xs text-gray-500 italic leading-relaxed">{{ $campaign->description }}</p>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span class="block text-[10px] font-black uppercase text-gray-500 tracking-widest mb-1">Raised</span>
                                            <span class="text-xl font-black text-green-500">₦{{ number_format($campaign->current_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-[10px] font-black uppercase text-gray-500 tracking-widest mb-1">Target</span>
                                            <span class="text-xl font-black text-white">₦{{ number_format($campaign->target_amount, 2) }}</span>
                                        </div>
                                    </div>

                                    @if($campaign->show_progress)
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                                            <span class="text-gray-500">Progress</span>
                                            <span class="text-green-500">{{ $campaign->progress }}%</span>
                                        </div>
                                        <div class="w-full bg-zinc-800 h-2 rounded-full overflow-hidden">
                                            <div class="bg-green-500 h-full rounded-full transition-all duration-1000" style="width: {{ $campaign->progress }}%"></div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="flex items-center space-x-4 pt-4 border-t border-zinc-800">
                                        <button type="button" @click="editCampaign = @js($campaign)" class="text-xs font-black uppercase text-blue-500 hover:text-blue-400 transition">Edit Details</button>
                                        <form action="{{ route('website.settings.deleteCampaign', $campaign) }}" method="POST" onsubmit="return confirm('Remove this campaign?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs font-black uppercase text-red-500 hover:text-red-400 transition">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Edit Campaign Modal -->
                        <div x-show="editCampaign" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">
                            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 max-w-lg w-full shadow-2xl" @click.away="editCampaign = null">
                                <div class="flex justify-between items-center mb-8">
                                    <h4 class="text-2xl font-black uppercase italic text-white tracking-tighter">Edit Campaign</h4>
                                    <button type="button" @click="editCampaign = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-xl"></i></button>
                                </div>
                                
                                <form x-bind:action="'{{ route('website.settings.updateCampaign', ['campaign' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editCampaign ? editCampaign.id : '')" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf @method('PUT')
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Campaign Title</label>
                                        <x-text-input name="title" x-model="editCampaign ? editCampaign.title : ''" required class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Target Amount (NGN)</label>
                                        <x-text-input type="number" name="target_amount" x-model="editCampaign ? editCampaign.target_amount : ''" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Description</label>
                                        <textarea name="description" x-model="editCampaign ? editCampaign.description : ''" class="w-full bg-white border-zinc-300 text-black rounded-xl focus:ring-green-500 h-32 text-sm"></textarea>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <div class="relative">
                                                <input type="checkbox" name="show_progress" value="1" :checked="editCampaign ? editCampaign.show_progress : false" class="sr-only peer">
                                                <div class="w-10 h-6 bg-zinc-700 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-4"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-gray-400 group-hover:text-white transition uppercase tracking-widest">Progress Meter</span>
                                        </label>
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <div class="relative">
                                                <input type="checkbox" name="is_active" value="1" :checked="editCampaign ? editCampaign.is_active : false" class="sr-only peer">
                                                <div class="w-10 h-6 bg-zinc-700 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-4"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-gray-400 group-hover:text-white transition uppercase tracking-widest">Active Status</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Change Image (Optional)</label>
                                        <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700">
                                    </div>
                                    <div class="flex justify-end space-x-4 pt-4">
                                        <button type="button" @click="editCampaign = null" class="text-zinc-500 text-xs font-bold uppercase hover:text-white transition">Cancel</button>
                                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase hover:bg-green-400 transition">Update Campaign</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                    <!-- Form Builder Panel -->
                    <section id="form-builder" class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-black uppercase italic text-white mb-8 flex items-center">
                            <i class="fa-solid fa-list-check text-green-500 mr-3"></i> Dynamic Form Builder
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Trial Registration Fields -->
                            <div class="space-y-6">
                                <h4 class="text-sm font-black uppercase tracking-widest text-green-500 border-b border-zinc-800 pb-2">Trial Form Fields</h4>
                                
                                <form action="{{ route('website.form.store') }}" method="POST" class="p-4 bg-black rounded-lg border border-zinc-800 space-y-4">
                                    @csrf
                                    <input type="hidden" name="form_type" value="trial">
                                    <x-text-input name="label" placeholder="Field Label (e.g. Guardian Name)" class="w-full text-xs" required />
                                    <select name="field_type" class="w-full bg-zinc-900 border-zinc-800 rounded text-xs text-white">
                                        <option value="text">Text Input</option>
                                        <option value="number">Number</option>
                                        <option value="date">Date</option>
                                        <option value="textarea">Text Area</option>
                                        <option value="file">File Upload</option>
                                    </select>
                                    <button type="submit" class="w-full bg-zinc-800 text-white py-2 rounded font-bold text-[10px] uppercase">Add Field</button>
                                </form>

                                <div class="space-y-2">
                                    @foreach($trialFields as $field)
                                    <div class="flex justify-between items-center p-3 bg-zinc-800 rounded border border-zinc-700">
                                        <span class="text-xs font-bold">{{ $field->label }} ({{ $field->field_type }})</span>
                                        <form action="{{ route('website.form.destroy', $field) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Coach Registration Fields -->
                            <div class="space-y-6">
                                <h4 class="text-sm font-black uppercase tracking-widest text-green-500 border-b border-zinc-800 pb-2">Coach Form Fields</h4>
                                
                                <form action="{{ route('website.form.store') }}" method="POST" class="p-4 bg-black rounded-lg border border-zinc-800 space-y-4">
                                    @csrf
                                    <input type="hidden" name="form_type" value="coach">
                                    <x-text-input name="label" placeholder="Field Label" class="w-full text-xs" required />
                                    <select name="field_type" class="w-full bg-zinc-900 border-zinc-800 rounded text-xs text-white">
                                        <option value="text">Text Input</option>
                                        <option value="number">Number</option>
                                        <option value="textarea">Text Area</option>
                                        <option value="file">File Upload</option>
                                    </select>
                                    <button type="submit" class="w-full bg-zinc-800 text-white py-2 rounded font-bold text-[10px] uppercase">Add Field</button>
                                </form>

                                <div class="space-y-2">
                                    @foreach($coachFields as $field)
                                    <div class="flex justify-between items-center p-3 bg-zinc-800 rounded border border-zinc-700">
                                        <span class="text-xs font-bold">{{ $field->label }} ({{ $field->field_type }})</span>
                                        <form action="{{ route('website.form.destroy', $field) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
