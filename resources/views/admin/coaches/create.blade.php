<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight italic uppercase">
            {{ __('Register New Coach') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 p-8 rounded-2xl shadow-xl">
                <form action="{{ route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Side: Basic Info -->
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Login Account</h3>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Full Name</label>
                                <x-text-input name="name" class="w-full" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Email Address</label>
                                <x-text-input type="email" name="email" class="w-full" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Initial Password</label>
                                <x-text-input type="password" name="password" class="w-full" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Right Side: Profile Info -->
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Coach Profile</h3>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Specialization</label>
                                <select name="specialization" class="w-full bg-white border-zinc-300 text-black focus:ring-green-500 focus:border-green-500">
                                    <option value="Tactical">Tactical Head Coach</option>
                                    <option value="Goalkeeping">Goalkeeping Coach</option>
                                    <option value="Fitness">Fitness & Strength</option>
                                    <option value="Youth Development">Youth Development</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Certification / Experience</label>
                                <x-text-input name="certification" class="w-full" placeholder="e.g. UEFA Pro License" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Upload Certificate (PDF/JPG)</label>
                                <input type="file" name="certificate_file" class="text-xs text-gray-400">
                                <x-input-error :messages="$errors->get('certificate_file')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Phone Number</label>
                                <x-text-input name="phone" class="w-full" placeholder="+234..." />
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Profile Photo</label>
                                <input type="file" name="photo" class="text-xs text-gray-400">
                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Detailed Experience / Bio</label>
                        <textarea name="experience" rows="4" class="w-full bg-white border-zinc-300 text-black focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <!-- Custom Fields -->
                    @if($customFields->count() > 0)
                    <div class="space-y-6 pt-6 border-t border-zinc-800">
                        <h3 class="text-xs font-black uppercase tracking-widest text-green-500 pb-2 border-b border-zinc-800">Additional Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($customFields as $field)
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">{{ $field->label }}</label>
                                @if($field->field_type == 'textarea')
                                    <textarea name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="w-full bg-white border-zinc-300 text-black rounded-lg text-sm focus:ring-green-500"></textarea>
                                @elseif($field->field_type == 'file')
                                    <input type="file" name="custom_{{ $field->field_name }}" {{ $field->is_required ? 'required' : '' }} class="text-xs text-gray-400">
                                @else
                                    <x-text-input name="custom_{{ $field->field_name }}" type="{{ $field->field_type }}" class="w-full" :required="$field->is_required" />
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-end pt-6 border-t border-zinc-800">
                        <button type="submit" class="bg-green-500 text-black px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-green-400 transition transform hover:scale-[1.02] shadow-lg shadow-green-500/20">
                            Register Coach
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
