<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Edit Profile</h3>

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('profiles.update', $profile->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" type="text" class="mt-1 block w-full" name="address"
                            :value="old('address', $profile->address)" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone" value="{{ __('Phone') }}" />
                        <x-jet-input id="phone" type="text" class="mt-1 block w-full" name="phone"
                            :value="old('phone', $profile->phone)" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" rows="4" class="form-textarea mt-1 block w-full" required>{{ old('description', $profile->description) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="profile_image" value="{{ __('Profile Image') }}" />
                        <x-jet-input id="profile_image" type="file" class="mt-1 block w-full" name="profile_image" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
