<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Gambar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Form Edit Gambar</h3>

                <form action="{{ route('image.update', $image) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                        <input type="file" name="image" id="image" class="border rounded-lg p-2">
                        <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                    </div>

                    {{-- <div class="mb-4">
                        <label for="link" class="block text-gray-700 text-sm font-bold mb-2">Link:</label>
                        <input type="text" name="link" id="link" class="border rounded-lg p-2"
                            value="{{ old('link', $image->link) }}">
                    </div> --}}

                    {{-- <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="border rounded-lg p-2" rows="3">{{ old('description', $image->description) }}</textarea>
                    </div> --}}

                    <div class="mt-4">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        <a href="{{ route('image.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
