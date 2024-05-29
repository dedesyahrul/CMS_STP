<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Kebijakan Privasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('kebijakan_privasis.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-jet-label for="judul" value="{{ __('Judul') }}" />
                            <x-jet-input id="judul" type="text" class="mt-1 block w-full" name="judul"
                                :value="old('judul')" required autofocus />
                            <x-jet-input-error for="judul" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label for="isi" value="{{ __('Isi') }}" />
                            <textarea id="isi" name="isi" rows="6" class="mt-1 block w-full" required>{{ old('isi') }}</textarea>
                            <x-jet-input-error for="isi" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
