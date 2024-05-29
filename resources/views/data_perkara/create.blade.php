<!-- resources/views/data_perkara/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Data Perkara') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold">Form Tambah Data Perkara</h3>
                <form action="{{ route('data-perkaras.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <x-jet-label for="no_putusan_perkara" value="No Putusan Perkara" />
                            <x-jet-input id="no_putusan_perkara" type="text" name="no_putusan_perkara"
                                class="block w-full mt-1" />
                        </div>
                        <div>
                            <x-jet-label for="tanggal_putusan" value="Tanggal Putusan" />
                            <x-jet-input id="tanggal_putusan" type="date" name="tanggal_putusan"
                                class="block w-full mt-1" />
                        </div>
                        <div>
                            <x-jet-label for="nama_tersangka" value="Nama Tersangka" />
                            <x-jet-input id="nama_tersangka" type="text" name="nama_tersangka"
                                class="block w-full mt-1" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-jet-button class="mt-4">
                            {{ __('Simpan Data Perkara') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
