<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Data Perkara') }}
            </h2>
            <a href="{{ route('data-perkaras.show', $dataPerkara->id) }}" class=" btn btn-sm btn-info">Back</a>
        </div>
    </x-slot>

    <div class="container">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <form method="POST" action="{{ route('data-perkaras.update-data-perkara', $dataPerkara->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="no_putusan_perkara" class="block text-sm font-medium text-gray-700">Nomor
                                Putusan
                                Perkara</label>
                            <input type="text" id="no_putusan_perkara" name="no_putusan_perkara"
                                value="{{ $dataPerkara->no_putusan_perkara }}"
                                class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_putusan" class="block text-sm font-medium text-gray-700">Tanggal
                                Putusan</label>
                            <input type="date" id="tanggal_putusan" name="tanggal_putusan"
                                value="{{ $dataPerkara->tanggal_putusan }}"
                                class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="nama_tersangka" class="block text-sm font-medium text-gray-700">Nama
                                Tersangka</label>
                            <input type="text" id="nama_tersangka" name="nama_tersangka"
                                value="{{ $dataPerkara->nama_tersangka }}"
                                class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <x-jet-button>Update Data Perkara</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
