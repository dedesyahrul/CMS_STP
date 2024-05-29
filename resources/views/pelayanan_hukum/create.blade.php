<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Pelayanan Hukum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pelayanan_hukum.store') }}">
                        @csrf

                        <div class="form-group">
                            <x-jet-label for="id_pelayanan_hukum" value="Nomor Pelayanan" />
                            <x-jet-input id="id_pelayanan_hukum" type="text" class="mt-1 block w-full"
                                name="id_pelayanan_hukum" :value="old('id_pelayanan_hukum', $newId)" required autofocus readonly />
                            <x-jet-input-error for="id_pelayanan_hukum" class="mt-2" />
                        </div>



                        @if (auth()->user()->role === 'masyarakat')
                            <div class="form-group">
                                <x-jet-label for="nik" value="NIK" />
                                <x-jet-input id="nik" type="text" class="mt-1 block w-full" name="nik"
                                    :value="old('nik', auth()->user()->masyarakat->nik ?? '')" required autofocus readonly />
                                <x-jet-input-error for="nik" class="mt-2" />
                            </div>
                        @endif


                        <div class="mt-4">
                            <x-jet-label for="nama" value="{{ __('Nama') }}" />
                            <x-jet-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                :value="old('nama')" required />
                            <x-jet-input-error for="nama" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="pertanyaan" value="{{ __('Pertanyaan') }}" />
                            <x-jet-input id="pertanyaan" class="block mt-1 w-full" type="text" name="pertanyaan"
                                :value="old('pertanyaan')" required />
                            <x-jet-input-error for="pertanyaan" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="nomor_hp" value="{{ __('Nomor HP') }}" />
                            <x-jet-input id="nomor_hp" class="block mt-1 w-full" type="text" name="nomor_hp"
                                :value="old('nomor_hp')" required />
                            <x-jet-input-error for="nomor_hp" class="mt-2" />
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
