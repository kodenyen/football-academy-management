<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Player Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your player specific information like age, position, and physical attributes.') }}
        </p>
    </header>

    <form method="post" action="{{ route('player.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        
        @php
            $player = auth()->user()->player;
        @endphp

        <!-- Age -->
        <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $player?->age)" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <!-- Position -->
        <div>
            <x-input-label for="position" :value="__('Position')" />
            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $player?->position)" />
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>

        <!-- Preferred Foot -->
        <div>
            <x-input-label for="preferred_foot" :value="__('Preferred Foot')" />
            <select id="preferred_foot" name="preferred_foot" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                <option value="">Select Foot</option>
                <option value="Right" {{ old('preferred_foot', $player?->preferred_foot) === 'Right' ? 'selected' : '' }}>Right</option>
                <option value="Left" {{ old('preferred_foot', $player?->preferred_foot) === 'Left' ? 'selected' : '' }}>Left</option>
                <option value="Both" {{ old('preferred_foot', $player?->preferred_foot) === 'Both' ? 'selected' : '' }}>Both</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('preferred_foot')" />
        </div>

        <!-- Height & Weight -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="height" :value="__('Height (cm)')" />
                <x-text-input id="height" name="height" type="number" step="0.1" class="mt-1 block w-full" :value="old('height', $player?->height)" />
                <x-input-error class="mt-2" :messages="$errors->get('height')" />
            </div>
            <div>
                <x-input-label for="weight" :value="__('Weight (kg)')" />
                <x-text-input id="weight" name="weight" type="number" step="0.1" class="mt-1 block w-full" :value="old('weight', $player?->weight)" />
                <x-input-error class="mt-2" :messages="$errors->get('weight')" />
            </div>
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio / Short Description')" />
            <textarea id="bio" name="bio" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('bio', $player?->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            @if($player?->profile_photo)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/' . $player->profile_photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif
            <input type="file" id="profile_photo" name="profile_photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700" accept="image/*">
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'player-profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>