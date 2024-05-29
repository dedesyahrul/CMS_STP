<!-- resources/views/barang_bukti/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tambah Barang Bukti') }}
            </h2>

            <a href="{{ route('data-perkaras.show', $dataPerkara->id) }}" class="btn btn-sm btn-info">Back</a>
        </div>
    </x-slot>
    <div class="container">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <!-- Form untuk menambahkan barang bukti -->
                    <form action="{{ route('barang-bukti.store', ['dataPerkara' => $dataPerkara->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Input untuk data barang bukti -->
                        <div class="mb-4">
                            <label for="nama_pemilik_barang_bukti" class="block text-sm font-medium text-gray-700">Nama
                                Pemilik Barang Bukti</label>
                            <input type="text" name="nama_pemilik_barang_bukti" id="nama_pemilik_barang_bukti"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" />
                        </div>
                        <div class="mb-4">
                            <label for="barang_bukti" class="block text-sm font-medium text-gray-700">Nama
                                Jenis Barang Bukti</label>
                            <input type="text" name="barang_bukti" id="barang_bukti"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" />
                        </div>
                        <div class="mb-4">
                            <label for="foto_barang_bukti" class="block text-sm font-medium text-gray-700">Foto Barang
                                Bukti</label>
                            <input type="file" name="foto_barang_bukti" id="foto_barang_bukti"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" />
                        </div>

                        <div class="mb-4">
                            <label for="lokasi_barang_bukti" class="block text-sm font-medium text-gray-700">Lokasi
                                Barang Bukti</label>
                            <input type="text" name="lokasi_barang_bukti" id="lokasi_barang_bukti"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" />
                        </div>
                        <!-- Hidden input untuk data_perkara_id -->
                        <input type="hidden" name="data_perkara_id" value="{{ $dataPerkara->id }}">
                        <!-- Tombol untuk menyimpan data -->
                        {{-- <button type="submit" class="btn btn-primary">Simpan Barang Bukti</button> --}}
                        <x-jet-button type="submit">
                            {{ __('Simpan Barang Bukti') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
