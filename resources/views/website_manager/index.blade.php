<x-app-layout>
    <x-slot name="header">
        {{ __('Website Management') }}
    </x-slot>

    <div class="py-12" x-data="{ 
        activeTab: window.location.hash ? window.location.hash.substring(1) : 'general',
        editFacility: null,
        editSlider: null,
        editProgram: null,
        editShowcase: null,
        editCampaign: null
    }" x-init="window.addEventListener('hashchange', () => activeTab = window.location.hash.substring(1))">
        
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <!-- Sidebar Navigation -->
            <div class="w-full lg:w-72 flex-shrink-0 space-y-4 lg:sticky lg:top-28">
                <div class="bg-white border border-slate-200 p-4 rounded-[2rem] shadow-sm">
                    <div class="px-4 py-6 border-b border-slate-100 mb-4">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Control Panel</h3>
                        <p class="text-xs text-slate-500 font-medium italic">Configure your academy</p>
                    </div>
                    
                    <nav class="space-y-1">
                        <button @click="activeTab = 'general'; window.location.hash = 'general'" 
                                :class="activeTab === 'general' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-house-chimney w-6 text-sm"></i> General
                        </button>

                        <button @click="activeTab = 'appearance'; window.location.hash = 'appearance'" 
                                :class="activeTab === 'appearance' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-palette w-6 text-sm"></i> Appearance
                        </button>

                        <button @click="activeTab = 'pages'; window.location.hash = 'pages'" 
                                :class="activeTab === 'pages' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-layer-group w-6 text-sm"></i> Content
                        </button>

                        <button @click="activeTab = 'media'; window.location.hash = 'media'" 
                                :class="activeTab === 'media' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-photo-film w-6 text-sm"></i> Gallery
                        </button>

                        <button @click="activeTab = 'showcase'; window.location.hash = 'showcase'" 
                                :class="activeTab === 'showcase' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-clapperboard w-6 text-sm"></i> Showcase
                        </button>

                        <button @click="activeTab = 'fundraising'; window.location.hash = 'fundraising'" 
                                :class="activeTab === 'fundraising' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-hand-holding-dollar w-6 text-sm"></i> Funding
                        </button>

                        <button @click="activeTab = 'integrations'; window.location.hash = 'integrations'" 
                                :class="activeTab === 'integrations' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-plug w-6 text-sm"></i> Integrations
                        </button>

                        <button @click="activeTab = 'forms'; window.location.hash = 'forms'" 
                                :class="activeTab === 'forms' ? 'bg-primary text-slate-900 shadow-md' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-black uppercase text-[10px] tracking-widest text-left">
                            <i class="fa-solid fa-list-check w-6 text-sm"></i> Forms
                        </button>
                    </nav>

                    <div class="mt-8 pt-8 border-t border-slate-100 px-2 space-y-2">
                        <span class="text-[9px] font-black uppercase text-slate-400 px-4 tracking-[0.2em]">Quick Access</span>
                        <a href="{{ route('website.news.index') }}" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:text-primary transition-colors uppercase italic">
                            <i class="fa-solid fa-newspaper mr-3 opacity-50"></i> News Updates
                        </a>
                        <a href="{{ route('website.fixtures.index') }}" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:text-primary transition-colors uppercase italic">
                            <i class="fa-solid fa-calendar-day mr-3 opacity-50"></i> Match Fixtures
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 w-full min-w-0">
                
                @if(session('success'))
                    <div class="bg-green-500 text-white p-5 rounded-2xl mb-8 shadow-lg flex items-center font-black uppercase text-xs tracking-widest animate-pulse">
                        <i class="fa-solid fa-circle-check mr-3 text-lg"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500 text-white p-5 rounded-2xl mb-8 shadow-lg font-bold text-xs">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- General Settings Tab -->
                <div x-show="activeTab === 'general'" x-transition class="space-y-8">
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-10 opacity-[0.03]">
                            <i class="fa-solid fa-house-chimney text-8xl"></i>
                        </div>
                        
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">
                            General Info
                        </h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Basic academy details and contact channels.</p>

                        <form action="{{ route('website.settings.updateGeneral') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Academy Name</label>
                                    <x-text-input name="academy_name" value="{{ $settings->academy_name }}" class="w-full border-slate-200 focus:border-primary focus:ring-primary/20 rounded-2xl py-4" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Academy Logo</label>
                                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        @if($settings->academy_logo)
                                            <img src="{{ asset('storage/' . $settings->academy_logo) }}" class="h-12 w-auto object-contain">
                                        @endif
                                        <input type="file" name="logo" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Showcase Hero Image</label>
                                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        @if($settings->showcase_hero)
                                            <img src="{{ asset('storage/' . $settings->showcase_hero) }}" class="h-12 w-auto object-contain">
                                        @endif
                                        <input type="file" name="showcase_hero" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                                    <x-text-input name="email" value="{{ $settings->email }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Phone Number</label>
                                    <x-text-input name="phone_number" value="{{ $settings->phone_number }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">WhatsApp Number</label>
                                    <x-text-input name="whatsapp_number" value="{{ $settings->whatsapp_number }}" class="w-full border-slate-200 rounded-2xl py-4" placeholder="+234..." />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Office Address</label>
                                    <x-text-input name="address" value="{{ $settings->address }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                </div>
                            </div>

                            <div class="pt-10 border-t border-slate-100 flex justify-end">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Appearance Tab -->
                <div x-show="activeTab === 'appearance'" x-transition class="space-y-8">
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm relative">
                         <div class="absolute top-0 right-0 p-10 opacity-[0.03]">
                            <i class="fa-solid fa-palette text-8xl"></i>
                        </div>

                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">Theme & Identity</h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Customize your website's colors and fonts.</p>

                        <form action="{{ route('website.settings.updateGeneral') }}" method="POST" class="space-y-12">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Primary Accent</label>
                                    <div class="flex items-center gap-4">
                                        <input type="color" name="primary_color" value="{{ $settings->primary_color }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                        <x-text-input value="{{ $settings->primary_color }}" class="flex-1 border-slate-200 rounded-2xl py-4 text-xs font-mono" readonly />
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Secondary Accent</label>
                                    <div class="flex items-center gap-4">
                                        <input type="color" name="secondary_color" value="{{ $settings->secondary_color }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                        <x-text-input value="{{ $settings->secondary_color }}" class="flex-1 border-slate-200 rounded-2xl py-4 text-xs font-mono" readonly />
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Background Base</label>
                                    <div class="flex items-center gap-4">
                                        <input type="color" name="background_color" value="{{ $settings->background_color ?? '#f8fafc' }}" class="w-16 h-16 bg-transparent border-0 rounded-2xl cursor-pointer">
                                        <x-text-input value="{{ $settings->background_color ?? '#f8fafc' }}" class="flex-1 border-slate-200 rounded-2xl py-4 text-xs font-mono" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-10 pt-10 border-t border-slate-100">
                                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-primary">Typography</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Heading Font</label>
                                        <x-text-input name="heading_font" value="{{ $settings->heading_font ?? 'Inter' }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Body Font</label>
                                        <x-text-input name="body_font" value="{{ $settings->body_font ?? 'Inter' }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                    </div>
                                </div>
                            </div>

                            <div class="pt-10 border-t border-slate-100 flex justify-end">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">
                                    Save Style
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Page Content Tab -->
                <div x-show="activeTab === 'pages'" x-transition class="space-y-12">
                    
                    <!-- About Page Section -->
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">About Us Content</h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Narrative and vision for the academy.</p>

                        <form action="{{ route('website.settings.updateAbout') }}" method="POST" class="space-y-10">
                            @csrf
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Main Narrative</label>
                                <textarea name="about_us_content" rows="6" class="w-full border-slate-200 rounded-[2rem] p-6 focus:border-primary focus:ring-primary/20 italic text-sm leading-relaxed">{{ $settings->about_us_content }}</textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Vision Statement</label>
                                    <textarea name="about_vision" rows="4" class="w-full border-slate-200 rounded-[1.5rem] p-6 focus:border-primary italic text-sm">{{ $settings->about_vision }}</textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Mission Statement</label>
                                    <textarea name="about_mission" rows="4" class="w-full border-slate-200 rounded-[1.5rem] p-6 focus:border-primary italic text-sm">{{ $settings->about_mission }}</textarea>
                                </div>
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">
                                    Update About
                                </button>
                            </div>
                        </form>

                        <div class="mt-16 pt-16 border-t border-slate-100">
                            <h4 class="text-xl font-black uppercase italic text-slate-900 mb-8">Facilities</h4>
                            
                            <form action="{{ route('website.settings.storeFacility') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 mb-10 space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-text-input name="name" placeholder="Facility Name" class="w-full border-slate-200 rounded-xl" required />
                                    <input type="file" name="image" class="text-xs text-slate-500">
                                </div>
                                <textarea name="description" placeholder="Description..." class="w-full border-slate-200 rounded-xl focus:ring-primary h-24 italic text-xs"></textarea>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-800 transition">Add Facility</button>
                                </div>
                            </form>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($facilities as $facility)
                                <div class="bg-white border border-slate-200 rounded-2xl p-6 group transition hover:border-primary/30">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 shrink-0">
                                            @if($facility->image)
                                                <img src="{{ asset('storage/' . $facility->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h5 class="text-sm font-black uppercase italic text-slate-900 truncate">{{ $facility->name }}</h5>
                                            <div class="flex items-center gap-3 mt-2">
                                                <button type="button" @click="editFacility = @js($facility)" class="text-[10px] font-black uppercase text-blue-500">Edit</button>
                                                <form action="{{ route('website.settings.deleteFacility', $facility) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-[10px] font-black uppercase text-red-500">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media & Gallery Tab -->
                <div x-show="activeTab === 'media'" x-transition class="space-y-12">
                    <!-- Sliders -->
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">Hero Banners</h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Homepage background images.</p>

                        <form action="{{ route('website.settings.storeSlider') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 mb-10 space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <input type="file" name="image" required class="text-xs">
                                <x-text-input name="heading" placeholder="Main Heading" class="w-full border-slate-200 rounded-xl" />
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Add Slide</button>
                            </div>
                        </form>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($sliders as $slider)
                            <div class="relative group aspect-video rounded-2xl overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $slider->image_path) }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-900/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 gap-4">
                                    <button @click="editSlider = @js($slider)" class="text-white"><i class="fa-solid fa-pen"></i></button>
                                    <form action="{{ route('website.settings.deleteSlider', $slider) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Fundraising Tab -->
                <div x-show="activeTab === 'fundraising'" x-transition class="space-y-12">
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">Funding Goals</h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Academy development funds.</p>

                        <form action="{{ route('website.settings.storeCampaign') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 mb-10 space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-text-input name="title" placeholder="Campaign Title" class="w-full border-slate-200 rounded-xl" required />
                                <x-text-input type="number" name="target_amount" placeholder="Target (₦)" class="w-full border-slate-200 rounded-xl" required />
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Launch Campaign</button>
                            </div>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($campaigns as $campaign)
                            <div class="bg-slate-50 border border-slate-100 rounded-[2rem] overflow-hidden group hover:border-primary transition-all duration-300">
                                <div class="p-8 space-y-6">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-xl font-black uppercase italic text-slate-900">{{ $campaign->title }}</h4>
                                        <span class="text-[10px] font-black uppercase {{ $campaign->is_active ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $campaign->is_active ? 'Active' : 'Hidden' }}
                                        </span>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[10px] font-black uppercase text-slate-400">
                                            <span>Progress</span>
                                            <span>₦{{ number_format($campaign->current_amount) }} / ₦{{ number_format($campaign->target_amount) }}</span>
                                        </div>
                                        <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                                            <div class="bg-primary h-full" style="width: {{ $campaign->progress }}%"></div>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-4 pt-4 border-t border-slate-200">
                                        <button @click="editCampaign = @js($campaign)" class="text-xs font-black uppercase text-blue-500">Edit</button>
                                        <form action="{{ route('website.settings.deleteCampaign', $campaign) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs font-black uppercase text-red-500">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Showcase Tab -->
                <div x-show="activeTab === 'showcase'" x-transition class="space-y-12">
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-2 tracking-tighter leading-none">Video Highlights</h3>
                        <p class="text-slate-500 text-sm font-medium italic mb-10">Talent showcase videos.</p>

                        <form action="{{ route('website.settings.storeShowcase') }}" method="POST" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 mb-10 space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-text-input name="title" placeholder="Video Title" class="w-full border-slate-200 rounded-xl" required />
                                <x-text-input name="youtube_url" placeholder="YouTube URL" class="w-full border-slate-200 rounded-xl" required />
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Add Highlight</button>
                            </div>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($showcaseVideos as $video)
                            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden group">
                                <div class="aspect-video bg-slate-900 relative">
                                    <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center bg-slate-900/40">
                                        <i class="fa-solid fa-play text-white text-3xl"></i>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h5 class="text-sm font-black uppercase italic text-slate-900 mb-4">{{ $video->title }}</h5>
                                    <div class="flex justify-end gap-4">
                                        <button @click="editShowcase = @js($video)" class="text-[10px] font-black uppercase text-blue-500">Edit</button>
                                        <form action="{{ route('website.settings.deleteShowcase', $video) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-[10px] font-black uppercase text-red-500">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Integrations Tab -->
                <div x-show="activeTab === 'integrations'" x-transition class="space-y-12">
                    <!-- Paystack -->
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm relative">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-10 tracking-tighter leading-none">Payment Gateway</h3>
                        <form action="{{ route('website.settings.updatePayment') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase text-slate-400">Public Key</label>
                                    <x-text-input name="paystack_public_key" value="{{ $settings->paystack_public_key }}" class="w-full border-slate-200 rounded-2xl py-4 font-mono text-xs" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase text-slate-400">Secret Key</label>
                                    <x-text-input type="password" name="paystack_secret_key" value="{{ $settings->paystack_secret_key }}" class="w-full border-slate-200 rounded-2xl py-4 font-mono text-xs" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-6">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Save Keys</button>
                            </div>
                        </form>
                    </div>

                    <!-- SMTP -->
                    <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm relative">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-10 tracking-tighter leading-none">Mail Server (SMTP)</h3>
                        <form action="{{ route('website.settings.updateMail') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase text-slate-400">Host</label>
                                    <x-text-input name="mail_host" value="{{ $settings->mail_host }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase text-slate-400">Port</label>
                                    <x-text-input name="mail_port" value="{{ $settings->mail_port }}" class="w-full border-slate-200 rounded-2xl py-4" />
                                </div>
                            </div>
                            <div class="flex justify-end pt-6">
                                <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Update SMTP</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Forms Tab -->
                <div x-show="activeTab === 'forms'" x-transition class="space-y-12">
                     <div class="bg-white border border-slate-200 p-10 rounded-[2.5rem] shadow-sm relative">
                        <h3 class="text-3xl font-black uppercase italic text-slate-900 mb-10 tracking-tighter leading-none">Registration Fields</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <!-- Trial -->
                            <div class="space-y-8">
                                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-primary border-b border-slate-100 pb-4">Trial Form</h4>
                                <form action="{{ route('website.form.store') }}" method="POST" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 space-y-6">
                                    @csrf
                                    <input type="hidden" name="form_type" value="trial">
                                    <x-text-input name="label" placeholder="Field Label" class="w-full border-slate-200 rounded-xl" required />
                                    <select name="field_type" class="w-full border-slate-200 rounded-xl text-[10px] font-black uppercase">
                                        <option value="text">Text</option>
                                        <option value="number">Numeric</option>
                                        <option value="date">Date</option>
                                        <option value="textarea">Long Text</option>
                                        <option value="file">File</option>
                                    </select>
                                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-[10px] uppercase">Add Field</button>
                                </form>

                                <div class="space-y-3">
                                    @foreach($trialFields as $field)
                                    <div class="flex justify-between items-center px-6 py-4 bg-white rounded-2xl border border-slate-100">
                                        <span class="text-[10px] font-black uppercase italic text-slate-900">{{ $field->label }}</span>
                                        <form action="{{ route('website.form.destroy', $field) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fa-solid fa-trash text-xs"></i></button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Coach -->
                            <div class="space-y-8">
                                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-primary border-b border-slate-100 pb-4">Coach Form</h4>
                                <form action="{{ route('website.form.store') }}" method="POST" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 space-y-6">
                                    @csrf
                                    <input type="hidden" name="form_type" value="coach">
                                    <x-text-input name="label" placeholder="Field Label" class="w-full border-slate-200 rounded-xl" required />
                                    <select name="field_type" class="w-full border-slate-200 rounded-xl text-[10px] font-black uppercase">
                                        <option value="text">Text</option>
                                        <option value="number">Numeric</option>
                                        <option value="textarea">Long Text</option>
                                        <option value="file">File</option>
                                    </select>
                                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-[10px] uppercase">Add Field</button>
                                </form>

                                <div class="space-y-3">
                                    @foreach($coachFields as $field)
                                    <div class="flex justify-between items-center px-6 py-4 bg-white rounded-2xl border border-slate-100">
                                        <span class="text-[10px] font-black uppercase italic text-slate-900">{{ $field->label }}</span>
                                        <form action="{{ route('website.form.destroy', $field) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500"><i class="fa-solid fa-trash text-xs"></i></button>
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

        <!-- Modals -->
        <!-- Edit Facility Modal -->
        <div x-show="editFacility" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div class="bg-white rounded-[2.5rem] p-10 max-w-lg w-full shadow-2xl relative" @click.away="editFacility = null">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-2xl font-black uppercase italic text-slate-900">Edit Facility</h4>
                    <button type="button" @click="editFacility = null"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                
                <form :action="'{{ route('website.settings.updateFacility', ['facility' => 'ID_PLACE_HOLDER']) }}'.replace('ID_PLACE_HOLDER', editFacility ? editFacility.id : '')" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf @method('PUT')
                    <x-text-input name="name" x-model="editFacility ? editFacility.name : ''" required class="w-full border-slate-200 rounded-2xl py-4" />
                    <textarea name="description" x-model="editFacility ? editFacility.description : ''" class="w-full border-slate-200 rounded-2xl p-6 italic text-sm"></textarea>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" @click="editFacility = null" class="text-slate-500 font-black uppercase text-[10px]">Cancel</button>
                        <button type="submit" class="bg-primary text-slate-900 px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
