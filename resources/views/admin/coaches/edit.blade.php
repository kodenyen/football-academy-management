<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Edit Coach Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Side: Basic Info -->
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Login Account</h3>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                                <x-text-input name="name" class="w-full" value="{{ $coach->user->name }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                                <x-text-input type="email" name="email" class="w-full" value="{{ $coach->user->email }}" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">New Password (leave blank to keep current)</label>
                                <x-text-input type="password" name="password" class="w-full" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Right Side: Profile Info -->
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Coach Profile</h3>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Specialization</label>
                                <select name="specialization" class="w-full bg-black border-zinc-800 rounded-lg text-sm text-white focus:ring-green-500 focus:border-green-500">
                                    <option value="Tactical" {{ $coach->specialization == 'Tactical' ? 'selected' : '' }}>Tactical Head Coach</option>
                                    <option value="Goalkeeping" {{ $coach->specialization == 'Goalkeeping' ? 'selected' : '' }}>Goalkeeping Coach</option>
                                    <option value="Fitness" {{ $coach->specialization == 'Fitness' ? 'selected' : '' }}>Fitness & Strength</option>
                                    <option value="Youth Development" {{ $coach->specialization == 'Youth Development' ? 'selected' : '' }}>Youth Development</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Certification / Experience</label>
                                <x-text-input name="certification" class="w-full" value="{{ $coach->certification }}" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Update Certificate (PDF/JPG)</label>
                                <input type="file" name="certificate_file" class="text-xs text-gray-400">
                                @if($coach->certificate_file)
                                    <p class="text-[10px] text-green-500 mt-1 uppercase font-bold italic">Certificate already uploaded</p>
                                @endif
                                <x-input-error :messages="$errors->get('certificate_file')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Phone Number</label>
                                <x-text-input name="phone" class="w-full" value="{{ $coach->phone }}" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Profile Photo (optional)</label>
                                <input type="file" name="photo" class="text-xs text-gray-400">
                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Detailed Experience / Bio</label>
                        <textarea name="experience" rows="4" class="w-full bg-black border-zinc-800 rounded-lg text-sm text-white focus:ring-green-500 focus:border-green-500">{{ $coach->experience }}</textarea>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-zinc-800">
                        <button type="submit" class="bg-blue-500 text-white px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-blue-400 transition transform hover:scale-[1.02] shadow-lg shadow-blue-500/20">
                            Update Coach Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
