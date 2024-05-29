<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bantuan Hukum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('bantuan_hukum.update', $bantuanHukum) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <x-jet-label for="instansi" value="Instansi" />
                            <x-jet-input id="instansi" type="text" class="mt-1 block w-full" name="instansi"
                                :value="old('instansi', $bantuanHukum->instansi)" required autofocus />
                            <x-jet-input-error for="instansi" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <x-jet-label for="perihal" value="Perihal" />
                            <x-jet-input id="perihal" type="text" class="mt-1 block w-full" name="perihal"
                                :value="old('perihal', $bantuanHukum->perihal)" required />
                            <x-jet-input-error for="perihal" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <x-jet-label for="unggah_file" value="Unggah File" />
                            <x-jet-input id="unggah_file" type="file" class="mt-1 block w-full" name="unggah_file" />
                            <x-jet-input-error for="unggah_file" class="mt-2" />
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
