<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone" value="{{ __('Phone') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="form-textarea mt-1 block w-full" rows="6" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="profile_image" value="{{ __('Profile Image') }}" />
                        <x-jet-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" />
                    </div>

                    <div class="flex items-center mt-4">
                        <x-jet-button>
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
