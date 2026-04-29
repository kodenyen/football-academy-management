<x-app-layout>
    <x-slot name="header">
        {{ __('Website Management') }}
    </x-slot>

    <div class="min-h-screen bg-zinc-950 -mt-10 -mx-4 sm:-mx-6 lg:-mx-8 py-12 text-gray-100" x-data="{ 
        activeTab: window.location.hash ? window.location.hash.substring(1) : 'general',
        editFacility: null,
        editSlider: null,
        editProgram: null,
        editShowcase: null,
        editCampaign: null
    }" x-init="window.addEventListener('hashchange', () => activeTab = window.location.hash.substring(1))">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-600 text-white p-5 rounded-2xl mb-8 shadow-xl shadow-green-600/20 flex items-center font-black uppercase text-xs tracking-widest animate-bounce">
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

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <!-- Sidebar Navigation -->
                <div class="w-full lg:w-72 flex-shrink-0 space-y-4 lg:sticky lg:top-8">
                    <div class="bg-zinc-900/50 backdrop-blur-xl border border-zinc-800 p-4 rounded-[2rem] shadow-2xl">
                        <div class="px-4 py-6 border-b border-zinc-800/50 mb-4">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-green-500">Control Panel</h3>
                            <p class="text-xs text-zinc-500 font-medium italic">Configure your academy</p>
                        </div>
                        
                        <nav class="space-y-1">
                            <button @click="activeTab = 'general'; window.location.hash = 'general'" 
                                    :class="activeTab === 'general' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-house-chimney w-6 text-sm"></i> General Settings
                            </button>

                            <button @click="activeTab = 'appearance'; window.location.hash = 'appearance'" 
                                    :class="activeTab === 'appearance' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-palette w-6 text-sm"></i> Appearance
                            </button>

                            <button @click="activeTab = 'pages'; window.location.hash = 'pages'" 
                                    :class="activeTab === 'pages' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-layer-group w-6 text-sm"></i> Page Content
                            </button>

                            <button @click="activeTab = 'media'; window.location.hash = 'media'" 
                                    :class="activeTab === 'media' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-photo-film w-6 text-sm"></i> Media & Gallery
                            </button>

                            <button @click="activeTab = 'showcase'; window.location.hash = 'showcase'" 
                                    :class="activeTab === 'showcase' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-clapperboard w-6 text-sm"></i> Showcase
                            </button>

                            <button @click="activeTab = 'fundraising'; window.location.hash = 'fundraising'" 
                                    :class="activeTab === 'fundraising' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-hand-holding-dollar w-6 text-sm"></i> Fundraising
                            </button>

                            <button @click="activeTab = 'integrations'; window.location.hash = 'integrations'" 
                                    :class="activeTab === 'integrations' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-plug w-6 text-sm"></i> Integrations
                            </button>

                            <button @click="activeTab = 'forms'; window.location.hash = 'forms'" 
                                    :class="activeTab === 'forms' ? 'bg-green-500 text-black shadow-lg shadow-green-500/20' : 'text-zinc-400 hover:bg-zinc-800 hover:text-white'"
                                    class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                                <i class="fa-solid fa-list-check w-6 text-sm"></i> Form Builder
                            </button>
                        </nav>

                        <div class="mt-8 pt-8 border-t border-zinc-800/50 px-2 space-y-2">
                            <span class="text-[9px] font-black uppercase text-zinc-600 px-4 tracking-[0.2em]">Quick Links</span>
                            <a href="{{ route('website.news.index') }}" class="flex items-center px-4 py-3 text-xs font-bold text-zinc-400 hover:text-green-500 transition-colors uppercase italic">
                                <i class="fa-solid fa-newspaper mr-3 opacity-50"></i> Manage News
                            </a>
                            <a href="{{ route('website.fixtures.index') }}" class="flex items-center px-4 py-3 text-xs font-bold text-zinc-400 hover:text-green-500 transition-colors uppercase italic">
                                <i class="fa-solid fa-calendar-day mr-3 opacity-50"></i> Manage Fixtures
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="flex-1 w-full min-w-0">
                    
                    <!-- General Settings Tab -->
                    <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl overflow-hidden relative">
                            <div class="absolute top-0 right-0 p-10 opacity-5">
                                <i class="fa-solid fa-house-chimney text-8xl"></i>
                            </div>
                            
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 flex items-center tracking-tighter leading-none">
                                General Settings
                            </h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Configure your academy's basic information and contact details.</p>

                            <form action="{{ route('website.settings.updateGeneral') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Academy Name</label>
                                        <x-text-input name="academy_name" value="{{ $settings->academy_name }}" class="w-full bg-black/40 border-zinc-800 focus:ring-green-500/50 rounded-2xl py-4" required />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Academy Logo</label>
                                        <div class="flex items-center gap-6 p-4 bg-black/20 rounded-2xl border border-zinc-800/50">
                                            @if($settings->academy_logo)
                                                <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-12 w-auto object-contain">
                                            @endif
                                            <input type="file" name="logo" class="text-xs text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white hover:file:bg-zinc-700">
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Email Address</label>
                                        <x-text-input name="email" value="{{ $settings->email }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Phone Number</label>
                                        <x-text-input name="phone_number" value="{{ $settings->phone_number }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">WhatsApp Number</label>
                                        <x-text-input name="whatsapp_number" value="{{ $settings->whatsapp_number }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="+234..." />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Office Address</label>
                                        <x-text-input name="address" value="{{ $settings->address }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                    </div>
                                </div>

                                <div class="pt-10 border-t border-zinc-800 flex justify-end">
                                    <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-green-400 transition transform hover:-translate-y-1 active:scale-95 shadow-xl shadow-green-500/20">
                                        Update General Info
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Appearance Tab -->
                    <div x-show="activeTab === 'appearance'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                             <div class="absolute top-0 right-0 p-10 opacity-5">
                                <i class="fa-solid fa-palette text-8xl"></i>
                            </div>

                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Theme & Style</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Customize your website's colors, fonts, and overall visual identity.</p>

                            <form action="{{ route('website.settings.updateGeneral') }}" method="POST" class="space-y-12">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Primary Color</label>
                                        <div class="flex items-center gap-4">
                                            <input type="color" name="primary_color" value="{{ $settings->primary_color }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                            <x-text-input value="{{ $settings->primary_color }}" class="flex-1 bg-black/40 border-zinc-800 rounded-2xl py-4 text-xs font-mono" readonly />
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Secondary Color</label>
                                        <div class="flex items-center gap-4">
                                            <input type="color" name="secondary_color" value="{{ $settings->secondary_color }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                            <x-text-input value="{{ $settings->secondary_color }}" class="flex-1 bg-black/40 border-zinc-800 rounded-2xl py-4 text-xs font-mono" readonly />
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Background Color</label>
                                        <div class="flex items-center gap-4">
                                            <input type="color" name="background_color" value="{{ $settings->background_color ?? '#18181b' }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                            <x-text-input value="{{ $settings->background_color ?? '#18181b' }}" class="flex-1 bg-black/40 border-zinc-800 rounded-2xl py-4 text-xs font-mono" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-10 pt-10 border-t border-zinc-800">
                                    <h4 class="text-xs font-black uppercase tracking-[0.3em] text-green-500">Typography Settings</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Heading Font (Google Font)</label>
                                            <x-text-input name="heading_font" value="{{ $settings->heading_font ?? 'Inter' }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="e.g. Montserrat" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Body Font (Google Font)</label>
                                            <x-text-input name="body_font" value="{{ $settings->body_font ?? 'Inter' }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="e.g. Open Sans" />
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Hero Heading Size</label>
                                            <x-text-input name="hero_heading_size" value="{{ $settings->hero_heading_size ?? 'text-5xl md:text-8xl' }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Hero Sub-heading Size</label>
                                            <x-text-input name="hero_subheading_size" value="{{ $settings->hero_subheading_size ?? 'text-lg md:text-xl' }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Section Heading Size</label>
                                            <x-text-input name="section_heading_size" value="{{ $settings->section_heading_size ?? 'text-4xl md:text-6xl' }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-10 border-t border-zinc-800 flex justify-end">
                                    <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-green-400 transition shadow-xl shadow-green-500/20">
                                        Save Styling
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Page Content Tab -->
                    <div x-show="activeTab === 'pages'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        
                        <!-- About Page Section -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">About Us Page</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Manage the core narrative and facilities displayed on the About page.</p>

                            <form action="{{ route('website.settings.updateAbout') }}" method="POST" class="space-y-10">
                                @csrf
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Main Narrative Content</label>
                                    <textarea name="about_us_content" rows="6" class="w-full bg-black/40 border-zinc-800 text-white rounded-[2rem] p-6 focus:ring-green-500 italic text-sm leading-relaxed">{{ $settings->about_us_content }}</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Vision Statement</label>
                                        <textarea name="about_vision" rows="4" class="w-full bg-black/40 border-zinc-800 text-white rounded-[1.5rem] p-6 focus:ring-green-500 italic text-sm">{{ $settings->about_vision }}</textarea>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Mission Statement</label>
                                        <textarea name="about_mission" rows="4" class="w-full bg-black/40 border-zinc-800 text-white rounded-[1.5rem] p-6 focus:ring-green-500 italic text-sm">{{ $settings->about_mission }}</textarea>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">YouTube Hero Video ID (e.g. dQw4w9WgXcQ)</label>
                                    <x-text-input name="about_video_id" value="{{ $settings->about_video_id }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-green-400 transition shadow-xl shadow-green-500/20">
                                        Update Narrative
                                    </button>
                                </div>
                            </form>

                            <div class="mt-16 pt-16 border-t border-zinc-800">
                                <h4 class="text-xl font-black uppercase italic text-white mb-8">Manage Facilities</h4>
                                
                                <form action="{{ route('website.settings.storeFacility') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 mb-10 space-y-6">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <x-text-input name="name" placeholder="Facility Name" class="w-full bg-zinc-900 border-zinc-800 rounded-xl" required />
                                        <input type="file" name="image" class="text-xs text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                                    </div>
                                    <textarea name="description" placeholder="Short description of the facility..." class="w-full bg-zinc-900 border-zinc-800 text-white rounded-xl focus:ring-green-500 h-24 italic text-xs"></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-zinc-800 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-zinc-700 transition">Add Facility</button>
                                    </div>
                                </form>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($facilities as $facility)
                                    <div class="bg-black/20 border border-zinc-800 rounded-2xl p-6 group transition hover:border-green-500/30">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-zinc-900 rounded-2xl overflow-hidden border border-zinc-800 shrink-0">
                                                @if($facility->image)
                                                    <img src="{{ asset('storage/' . $facility->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h5 class="text-sm font-black uppercase italic text-white truncate">{{ $facility->name }}</h5>
                                                <div class="flex items-center gap-3 mt-2">
                                                    <button type="button" @click="editFacility = @js($facility)" class="text-[10px] font-black uppercase text-blue-500 hover:text-blue-400">Edit</button>
                                                    <form action="{{ route('website.settings.deleteFacility', $facility) }}" method="POST" onsubmit="return confirm('Remove facility?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-[10px] font-black uppercase text-red-500 hover:text-red-400">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Footer Section -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl">
                             <h3 class="text-xl font-black uppercase italic text-white mb-8">Footer & Legal</h3>
                             <form action="{{ route('website.settings.updateGeneral') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Copyright / Footer Text</label>
                                    <x-text-input name="footer_text" value="{{ $settings->footer_text }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-400 transition shadow-xl shadow-green-500/20">
                                        Update Footer
                                    </button>
                                </div>
                             </form>
                        </div>
                    </div>

                    <!-- Media & Gallery Tab -->
                    <div x-show="activeTab === 'media'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        
                        <!-- Hero Slider Management -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Hero Sliders</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Manage the dynamic background images on your homepage.</p>

                            <form action="{{ route('website.settings.storeSlider') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 mb-10 space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Hero Image</label>
                                        <input type="file" name="image" required class="w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Main Heading</label>
                                        <x-text-input name="heading" placeholder="e.g. Elite Football Excellence" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-zinc-800 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-zinc-700 transition">Add to Slider</button>
                                </div>
                            </form>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach($sliders as $slider)
                                <div class="relative group aspect-video rounded-2xl overflow-hidden border border-zinc-800 bg-black">
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover opacity-50 group-hover:opacity-100 transition duration-700">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-500 space-x-3">
                                        <button @click="editSlider = @js($slider)" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg"><i class="fa-solid fa-pen text-xs"></i></button>
                                        <form action="{{ route('website.settings.deleteSlider', $slider) }}" method="POST" onsubmit="return confirm('Remove slider?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg"><i class="fa-solid fa-trash text-xs"></i></button>
                                        </form>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-black/80 backdrop-blur-md">
                                        <p class="text-[9px] font-black uppercase text-white truncate text-center tracking-tighter">{{ $slider->heading }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Gallery Management -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Media Gallery</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Upload and manage images for the public gallery hub.</p>

                            <form action="{{ route('website.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 mb-10 space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Gallery Image</label>
                                        <input type="file" name="file" required class="w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Media Caption</label>
                                        <x-text-input name="title" placeholder="e.g. Finals 2026" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-600 text-white px-10 py-3 rounded-xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-blue-500 transition shadow-xl shadow-blue-600/20">Upload Media</button>
                                </div>
                            </form>

                            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                @foreach($gallery as $item)
                                <div class="relative group aspect-square rounded-2xl overflow-hidden border border-zinc-800 bg-black">
                                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition duration-700">
                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-500">
                                        <form action="{{ route('website.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete media?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-500 w-10 h-10 rounded-full flex items-center justify-center hover:scale-125 transition shadow-2xl"><i class="fa-solid fa-trash text-xs"></i></button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Showcase Tab -->
                    <div x-show="activeTab === 'showcase'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Student Showcase</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Manage the elite highlight reels featured on the talent showcase page.</p>

                            <form action="{{ route('website.settings.storeShowcase') }}" method="POST" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 mb-10 space-y-8">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Highlight Title</label>
                                        <x-text-input name="title" placeholder="e.g. Marcus John - Technical Mastery" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" required />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Field Position</label>
                                        <x-text-input name="position" placeholder="e.g. Advanced Playmaker" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">YouTube URL</label>
                                        <x-text-input name="youtube_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" required />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Link to Registered Student</label>
                                        <select name="player_id" class="w-full bg-zinc-900 border-zinc-800 text-white rounded-xl py-3.5 focus:ring-green-500 font-bold text-xs uppercase italic">
                                            <option value="">Generic Academy Video</option>
                                            @foreach($players as $player)
                                                <option value="{{ $player->id }}">{{ $player->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex justify-end pt-4 border-t border-zinc-800/50">
                                    <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-green-400 transition shadow-xl shadow-green-500/20">
                                        Add to Showcase
                                    </button>
                                </div>
                            </form>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($showcaseVideos as $video)
                                <div class="bg-black border border-zinc-800 rounded-3xl overflow-hidden group hover:border-green-500/50 transition duration-500">
                                    <div class="aspect-video relative bg-zinc-900 overflow-hidden">
                                        <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" class="w-full h-full object-cover opacity-40 group-hover:scale-110 transition duration-1000 group-hover:opacity-100">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center group-hover:scale-125 transition shadow-2xl">
                                                <i class="fa-solid fa-play text-black text-sm ml-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-8">
                                        <h5 class="text-xs font-black uppercase italic text-white tracking-widest mb-1">{{ $video->title }}</h5>
                                        <p class="text-[9px] font-black uppercase text-green-500 italic">{{ $video->position ?? 'Academy Feature' }}</p>
                                        <div class="mt-6 pt-6 border-t border-zinc-800/50 flex items-center justify-between">
                                            <button @click="editShowcase = @js($video)" class="text-[9px] font-black uppercase text-zinc-400 hover:text-blue-500 transition">Edit Details</button>
                                            <form action="{{ route('website.settings.deleteShowcase', $video) }}" method="POST" onsubmit="return confirm('Remove highlight?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-[9px] font-black uppercase text-red-500 hover:text-red-400 transition">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Fundraising Tab -->
                    <div x-show="activeTab === 'fundraising'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Funding Campaigns</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Create and manage fundraising goals for academy development and scholarship funds.</p>

                            <form action="{{ route('website.settings.storeCampaign') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 mb-10 space-y-8">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Campaign Title</label>
                                        <x-text-input name="title" placeholder="e.g. New Training Ground Fund" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" required />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Target Amount (₦)</label>
                                        <x-text-input type="number" name="target_amount" placeholder="e.g. 5000000" class="w-full bg-zinc-900 border-zinc-800 rounded-xl py-3" required />
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Campaign Description</label>
                                    <textarea name="description" rows="4" class="w-full bg-zinc-900 border-zinc-800 text-white rounded-xl p-6 focus:ring-green-500 italic text-xs" placeholder="Describe the impact of this fund..."></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Hero Image</label>
                                        <input type="file" name="image" class="w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                                    </div>
                                    <div class="flex items-center gap-8">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" name="show_progress" value="1" checked class="w-5 h-5 rounded border-zinc-800 bg-zinc-900 text-green-500 focus:ring-green-500/50">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-white transition">Show Meter</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-green-400 transition shadow-xl shadow-green-500/20">
                                        Launch Campaign
                                    </button>
                                </div>
                            </form>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                @foreach($campaigns as $campaign)
                                <div class="bg-black/40 border border-zinc-800 rounded-[2rem] overflow-hidden group hover:border-green-500/30 transition duration-500">
                                    <div class="h-48 relative overflow-hidden bg-zinc-900">
                                        @if($campaign->image)
                                            <img src="{{ asset('storage/' . $campaign->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-1000">
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent flex flex-col justify-end p-8">
                                            <span class="text-[10px] font-black uppercase tracking-widest {{ $campaign->is_active ? 'text-green-500' : 'text-red-500' }} mb-2">
                                                {{ $campaign->is_active ? '● LIVE CAMPAIGN' : '○ INACTIVE' }}
                                            </span>
                                            <h4 class="text-xl font-black uppercase italic text-white leading-none">{{ $campaign->title }}</h4>
                                        </div>
                                    </div>
                                    <div class="p-8 space-y-8">
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <span class="block text-[10px] font-black uppercase text-zinc-500 tracking-widest mb-1">Current Pot</span>
                                                <span class="text-xl font-black text-green-500">₦{{ number_format($campaign->current_amount, 2) }}</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="block text-[10px] font-black uppercase text-zinc-500 tracking-widest mb-1">Target</span>
                                                <span class="text-xl font-black text-white">₦{{ number_format($campaign->target_amount, 2) }}</span>
                                            </div>
                                        </div>

                                        @if($campaign->show_progress)
                                        <div class="space-y-3">
                                            <div class="w-full bg-zinc-900 h-2.5 rounded-full overflow-hidden border border-zinc-800">
                                                <div class="bg-green-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(34,197,94,0.3)]" style="width: {{ $campaign->progress }}%"></div>
                                            </div>
                                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest italic">
                                                <span class="text-zinc-500">Milestone</span>
                                                <span class="text-green-500">{{ $campaign->progress }}% Achieved</span>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="flex items-center justify-between pt-6 border-t border-zinc-800/50">
                                            <button @click="editCampaign = @js($campaign)" class="text-[9px] font-black uppercase text-zinc-400 hover:text-blue-500 transition">Update Goal</button>
                                            <form action="{{ route('website.settings.deleteCampaign', $campaign) }}" method="POST" onsubmit="return confirm('Kill campaign?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-[9px] font-black uppercase text-red-500 hover:text-red-400 transition">Kill Campaign</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Integrations Tab -->
                    <div x-show="activeTab === 'integrations'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        
                        <!-- Paystack Section -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                             <div class="absolute top-0 right-0 p-10 opacity-5">
                                <i class="fa-solid fa-credit-card text-8xl"></i>
                            </div>
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Payment Gateway</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Securely connect your Paystack account to process registrations and donations.</p>

                            <form action="{{ route('website.settings.updatePayment') }}" method="POST" class="space-y-8">
                                @csrf
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Public Key</label>
                                        <x-text-input name="paystack_public_key" value="{{ $settings->paystack_public_key }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4 font-mono text-xs text-green-500" placeholder="pk_live_..." />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Secret Key</label>
                                        <x-text-input type="password" name="paystack_secret_key" value="{{ $settings->paystack_secret_key }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4 font-mono text-xs" placeholder="sk_live_..." />
                                    </div>
                                </div>
                                <div class="flex justify-end pt-6">
                                    <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-blue-500 transition shadow-xl shadow-blue-600/20">
                                        Save Gateway Keys
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Email Section -->
                        <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <div class="absolute top-0 right-0 p-10 opacity-5">
                                <i class="fa-solid fa-envelope text-8xl"></i>
                            </div>
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">SMTP Configuration</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Configure outgoing email settings for notifications and receipts.</p>

                            <form action="{{ route('website.settings.updateMail') }}" method="POST" class="space-y-10">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Host Server</label>
                                        <x-text-input name="mail_host" value="{{ $settings->mail_host }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="smtp.mailtrap.io" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Port</label>
                                        <x-text-input name="mail_port" value="{{ $settings->mail_port }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="587" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Username</label>
                                        <x-text-input name="mail_username" value="{{ $settings->mail_username }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Password</label>
                                        <x-text-input type="password" name="mail_password" value="{{ $settings->mail_password }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Encryption</label>
                                        <select name="mail_encryption" class="w-full bg-black/40 border-zinc-800 text-white rounded-2xl py-3.5 focus:ring-green-500 font-bold text-[10px] uppercase tracking-widest">
                                            <option value="tls" {{ $settings->mail_encryption == 'tls' ? 'selected' : '' }}>TLS (Secure)</option>
                                            <option value="ssl" {{ $settings->mail_encryption == 'ssl' ? 'selected' : '' }}>SSL (Legacy)</option>
                                            <option value="" {{ !$settings->mail_encryption ? 'selected' : '' }}>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-10 border-t border-zinc-800">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">From Email Address</label>
                                        <x-text-input name="mail_from_address" value="{{ $settings->mail_from_address }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="noreply@academy.com" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">From Sender Name</label>
                                        <x-text-input name="mail_from_name" value="{{ $settings->mail_from_name }}" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" placeholder="ThinkRight Academy" />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-blue-500 transition shadow-xl shadow-blue-600/20">
                                        Update SMTP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Form Builder Tab -->
                    <div x-show="activeTab === 'forms'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                         <div class="bg-zinc-900 border border-zinc-800 p-10 rounded-[2.5rem] shadow-2xl relative">
                            <h3 class="text-3xl font-black uppercase italic text-white mb-2 tracking-tighter leading-none">Field Management</h3>
                            <p class="text-zinc-500 text-sm font-medium italic mb-10">Add or remove custom fields for student and coach registration forms.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                <!-- Trial Form -->
                                <div class="space-y-8">
                                    <h4 class="text-xs font-black uppercase tracking-[0.3em] text-green-500 border-b border-zinc-800/50 pb-4">Trial Registration</h4>
                                    
                                    <form action="{{ route('website.form.store') }}" method="POST" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 space-y-6">
                                        @csrf
                                        <input type="hidden" name="form_type" value="trial">
                                        <div class="space-y-2">
                                            <label class="block text-[9px] font-black uppercase text-zinc-500 ml-1 tracking-widest">Field Label</label>
                                            <x-text-input name="label" placeholder="e.g. Current School" class="w-full bg-zinc-900 border-zinc-800 rounded-xl" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[9px] font-black uppercase text-zinc-500 ml-1 tracking-widest">Field Type</label>
                                            <select name="field_type" class="w-full bg-zinc-900 border-zinc-800 text-white rounded-xl text-[10px] font-black uppercase tracking-widest">
                                                <option value="text">Short Text</option>
                                                <option value="number">Numeric</option>
                                                <option value="date">Date Picker</option>
                                                <option value="textarea">Long Text</option>
                                                <option value="file">File Upload</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full bg-zinc-800 text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-zinc-700 transition">Add To Form</button>
                                    </form>

                                    <div class="space-y-3">
                                        @foreach($trialFields as $field)
                                        <div class="flex justify-between items-center px-6 py-4 bg-black/20 rounded-2xl border border-zinc-800 group hover:border-green-500/30 transition">
                                            <div class="flex items-center gap-4">
                                                <div class="w-2 h-2 rounded-full bg-green-500 opacity-50 group-hover:opacity-100"></div>
                                                <span class="text-[10px] font-black uppercase italic text-white tracking-widest">{{ $field->label }} <span class="text-zinc-600 font-medium ml-2">({{ $field->field_type }})</span></span>
                                            </div>
                                            <form action="{{ route('website.form.destroy', $field) }}" method="POST" onsubmit="return confirm('Kill field?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-zinc-600 hover:text-red-500 transition"><i class="fa-solid fa-xmark"></i></button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Coach Form -->
                                <div class="space-y-8">
                                    <h4 class="text-xs font-black uppercase tracking-[0.3em] text-green-500 border-b border-zinc-800/50 pb-4">Coach Application</h4>
                                    
                                    <form action="{{ route('website.form.store') }}" method="POST" class="p-8 bg-black/40 rounded-[2rem] border border-zinc-800 space-y-6">
                                        @csrf
                                        <input type="hidden" name="form_type" value="coach">
                                        <div class="space-y-2">
                                            <label class="block text-[9px] font-black uppercase text-zinc-500 ml-1 tracking-widest">Field Label</label>
                                            <x-text-input name="label" placeholder="e.g. Total Exp (Years)" class="w-full bg-zinc-900 border-zinc-800 rounded-xl" required />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[9px] font-black uppercase text-zinc-500 ml-1 tracking-widest">Field Type</label>
                                            <select name="field_type" class="w-full bg-zinc-900 border-zinc-800 text-white rounded-xl text-[10px] font-black uppercase tracking-widest">
                                                <option value="text">Short Text</option>
                                                <option value="number">Numeric</option>
                                                <option value="textarea">Long Text Area</option>
                                                <option value="file">File Upload</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full bg-zinc-800 text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-zinc-700 transition">Add To Form</button>
                                    </form>

                                    <div class="space-y-3">
                                        @foreach($coachFields as $field)
                                        <div class="flex justify-between items-center px-6 py-4 bg-black/20 rounded-2xl border border-zinc-800 group hover:border-green-500/30 transition">
                                            <div class="flex items-center gap-4">
                                                <div class="w-2 h-2 rounded-full bg-green-500 opacity-50 group-hover:opacity-100"></div>
                                                <span class="text-[10px] font-black uppercase italic text-white tracking-widest">{{ $field->label }} <span class="text-zinc-600 font-medium ml-2">({{ $field->field_type }})</span></span>
                                            </div>
                                            <form action="{{ route('website.form.destroy', $field) }}" method="POST" onsubmit="return confirm('Kill field?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-zinc-600 hover:text-red-500 transition"><i class="fa-solid fa-xmark"></i></button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Shared Modals (Teleported or nested) -->
        
        <!-- Edit Facility Modal -->
        <div x-show="editFacility" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl">
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-10 max-w-lg w-full shadow-2xl overflow-hidden relative" @click.away="editFacility = null">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-3xl font-black uppercase italic text-white tracking-tighter leading-none">Edit Facility</h4>
                    <button type="button" @click="editFacility = null" class="text-zinc-500 hover:text-white transition transform hover:rotate-90"><i class="fa-solid fa-xmark text-2xl"></i></button>
                </div>
                
                <form :action="'{{ route('website.settings.updateFacility', ['facility' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editFacility ? editFacility.id : '')" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Facility Name</label>
                        <x-text-input name="name" x-model="editFacility ? editFacility.name : ''" required class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Change Media</label>
                        <input type="file" name="image" class="w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Narrative</label>
                        <textarea name="description" x-model="editFacility ? editFacility.description : ''" class="w-full bg-black/40 border-zinc-800 text-white rounded-2xl p-6 focus:ring-green-500 h-32 italic text-sm"></textarea>
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" @click="editFacility = null" class="text-zinc-500 font-black uppercase text-[10px] tracking-widest hover:text-white transition">Cancel</button>
                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-400 transition shadow-xl shadow-green-500/20">Update Facility</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Slider Modal -->
        <div x-show="editSlider" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl">
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-10 max-w-lg w-full shadow-2xl relative" @click.away="editSlider = null">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-3xl font-black uppercase italic text-white tracking-tighter leading-none">Edit Slider</h4>
                    <button type="button" @click="editSlider = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-2xl"></i></button>
                </div>
                
                <form x-bind:action="'{{ route('website.settings.updateSlider', ['slider' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editSlider ? editSlider.id : '')" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Main Heading</label>
                        <x-text-input name="heading" x-model="editSlider ? editSlider.heading : ''" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Sub-narrative</label>
                        <x-text-input name="sub_heading" x-model="editSlider ? editSlider.sub_heading : ''" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Replace Image</label>
                        <input type="file" name="image" class="w-full text-xs text-zinc-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-800 file:text-white">
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" @click="editSlider = null" class="text-zinc-500 font-black uppercase text-[10px] tracking-widest hover:text-white transition">Cancel</button>
                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-400 transition shadow-xl shadow-green-500/20">Update Slide</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Showcase Modal -->
        <div x-show="editShowcase" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl">
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-10 max-w-lg w-full shadow-2xl relative" @click.away="editShowcase = null">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-3xl font-black uppercase italic text-white tracking-tighter leading-none">Edit Showcase</h4>
                    <button type="button" @click="editShowcase = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-2xl"></i></button>
                </div>
                
                <form x-bind:action="'{{ route('website.settings.updateShowcase', ['showcase' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editShowcase ? editShowcase.id : '')" method="POST" class="space-y-8">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Title</label>
                        <x-text-input name="title" x-model="editShowcase ? editShowcase.title : ''" required class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">YouTube URL</label>
                        <x-text-input name="youtube_url" x-model="editShowcase ? editShowcase.youtube_url : ''" required class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="flex items-center gap-4 py-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" :checked="editShowcase ? editShowcase.is_active : false" class="w-6 h-6 rounded-lg border-zinc-800 bg-black text-green-500 focus:ring-green-500/30">
                            <span class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-white transition">Show Publicly</span>
                        </label>
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" @click="editShowcase = null" class="text-zinc-500 font-black uppercase text-[10px] tracking-widest hover:text-white transition">Cancel</button>
                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-400 transition shadow-xl shadow-green-500/20">Update Highlight</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Campaign Modal -->
        <div x-show="editCampaign" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-xl">
            <div class="bg-zinc-900 border border-zinc-800 rounded-[2.5rem] p-10 max-w-lg w-full shadow-2xl relative" @click.away="editCampaign = null">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-3xl font-black uppercase italic text-white tracking-tighter leading-none">Edit Goal</h4>
                    <button type="button" @click="editCampaign = null" class="text-zinc-500 hover:text-white transition"><i class="fa-solid fa-xmark text-2xl"></i></button>
                </div>
                
                <form x-bind:action="'{{ route('website.settings.updateCampaign', ['campaign' => 'ID_PLACEHOLDER']) }}'.replace('ID_PLACEHOLDER', editCampaign ? editCampaign.id : '')" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Title</label>
                        <x-text-input name="title" x-model="editCampaign ? editCampaign.title : ''" required class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Target Amount (₦)</label>
                        <x-text-input type="number" name="target_amount" x-model="editCampaign ? editCampaign.target_amount : ''" class="w-full bg-black/40 border-zinc-800 rounded-2xl py-4" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 ml-1">Narrative</label>
                        <textarea name="description" x-model="editCampaign ? editCampaign.description : ''" class="w-full bg-black/40 border-zinc-800 text-white rounded-2xl p-6 focus:ring-green-500 h-32 italic text-sm"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="show_progress" value="1" :checked="editCampaign ? editCampaign.show_progress : false" class="w-6 h-6 rounded-lg border-zinc-800 bg-black text-green-500 focus:ring-green-500/30">
                            <span class="text-[9px] font-black uppercase tracking-widest text-zinc-500 group-hover:text-white transition">Show Meter</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" :checked="editCampaign ? editCampaign.is_active : false" class="w-6 h-6 rounded-lg border-zinc-800 bg-black text-green-500 focus:ring-green-500/30">
                            <span class="text-[9px] font-black uppercase tracking-widest text-zinc-500 group-hover:text-white transition">Active Status</span>
                        </label>
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" @click="editCampaign = null" class="text-zinc-500 font-black uppercase text-[10px] tracking-widest hover:text-white transition">Cancel</button>
                        <button type="submit" class="bg-green-500 text-black px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-green-400 transition shadow-xl shadow-green-500/20">Update Campaign</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
