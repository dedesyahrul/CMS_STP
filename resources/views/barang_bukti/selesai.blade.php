<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Selesai Pengambilan Barang Bukti') }}
            </h2>
            <a href="{{ route('permohonan-pengambilan.show', $barangBukti->id) }}" class="btn btn-primary">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold">Selesai Pengambilan Barang Bukti</h3>
                <form action="{{ route('selesai-pengambilan.complete', $barangBukti->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="ba_serah_terima" class="block text-sm font-medium text-gray-700">Berkas Berita Acara
                            Serah
                            Terima:</label>
                        <input type="file" name="ba_serah_terima" id="ba_serah_terima"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="d_serah_terima" class="block text-sm font-medium text-gray-700">Berkas Dokumentasi
                            Serah
                            Terima:</label>
                        <input type="file" name="d_serah_terima" id="d_serah_terima"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mt-6">
                        <x-jet-button type="submit">Selesai</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
