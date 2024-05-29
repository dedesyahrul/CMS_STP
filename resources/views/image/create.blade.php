<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Gambar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Form Tambah Gambar</h3>

                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-jet-label for="image" value="Gambar" />
                        <x-jet-input type="file" name="image" id="image" class="block mt-1 w-full" required />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="link" value="Link" />
                        <x-jet-input type="text" name="link" id="link" class="block mt-1 w-full" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="description" value="Description" />
                        <x-jet-input type="text" name="description" id="description" class="block mt-1 w-full" />
                    </div>

                    <div class="mt-4">
                        <x-jet-button type="submit">Tambah</x-jet-button>
                        <a href="{{ route('image.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
