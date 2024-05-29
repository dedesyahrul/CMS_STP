<!-- resources/views/barang_bukti/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Barang Bukti') }}
            </h2>
            <a href="{{ route('data-perkaras.show', $barangBukti->data_perkara_id) }}"
                class="btn btn-sm btn-info">Back</a>
        </div>
    </x-slot>
    <div class="container">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <form method="POST" action="{{ route('barang-bukti.update', $barangBukti->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-jet-label for="nama_pemilik_barang_bukti" value="Nama Pemilik Barang Bukti" />
                            <x-jet-input id="nama_pemilik_barang_bukti" class="block mt-1 w-full" type="text"
                                name="nama_pemilik_barang_bukti" :value="$barangBukti->nama_pemilik_barang_bukti" required autofocus />
                            <x-jet-input-error for="nama_pemilik_barang_bukti" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="barang_bukti" value="Barang Bukti" />
                            <x-jet-input id="barang_bukti" class="block mt-1 w-full" type="text" name="barang_bukti"
                                :value="$barangBukti->barang_bukti" required />
                            <x-jet-input-error for="barang_bukti" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="lokasi_barang_bukti" value="Lokasi Barang Bukti" />
                            <x-jet-input id="lokasi_barang_bukti" class="block mt-1 w-full" type="text"
                                name="lokasi_barang_bukti" :value="$barangBukti->lokasi_barang_bukti" required />
                            <x-jet-input-error for="lokasi_barang_bukti" class="mt-2" />
                        </div>

                        <!-- Input field untuk menampilkan foto barang bukti yang ada -->
                        <div class="mt-4">
                            <x-jet-label value="Foto Barang Bukti Sekarang" />
                            <div class="mt-2">
                                <img src="{{ asset('public/foto_barang_bukti/' . $barangBukti->foto_barang_bukti) }}"
                                    alt="Foto Barang Bukti" class="max-w-xs max-h-xs" />
                            </div>
                        </div>

                        <!-- Input field untuk mengunggah foto barang bukti baru -->
                        <div class="mt-4">
                            <x-jet-label for="foto_barang_bukti" value="Upload Foto Barang Bukti Baru" />
                            <x-jet-input id="foto_barang_bukti" class="block mt-1 w-full" type="file"
                                name="foto_barang_bukti" />
                            <x-jet-input-error for="foto_barang_bukti" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
