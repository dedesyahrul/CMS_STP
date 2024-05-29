<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Detail Data Perkara') }}
            </h2>
            <x-button href="{{ route('data-perkaras.index') }}" class="btn btn-primary">
                Back
            </x-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">No. Putusan Perkara:</h3>
                        <p class="text-gray-700">{{ $dataPerkara->no_putusan_perkara }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Tanggal Putusan:</h3>
                        <p class="text-gray-700">{{ $dataPerkara->tanggal_putusan }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Nama Tersangka:</h3>
                        <p class="text-gray-700">{{ $dataPerkara->nama_tersangka }}</p>
                    </div>
                    <div class="mb-4">
                        <x-button href="{{ route('data-perkaras.edit', $dataPerkara->id) }}" class="btn btn-primary">
                            Edit Data Perkara
                        </x-button>
                    </div>
                    <hr class="my-4">
                    @if ($dataPerkara->barangBuktis->isNotEmpty())
                        <h3 class="mb-4 text-lg font-bold">Barang Bukti Perkara:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($dataPerkara->barangBuktis as $barangBukti)
                                <div class="bg-white shadow-lg rounded-lg p-6">
                                    <div class="flex justify-between mb-2">
                                        <h4 class="text-md font-semibold">Nama Pemilik:</h4>
                                        <p class="text-gray-700">{{ $barangBukti->nama_pemilik_barang_bukti }}</p>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="text-md font-semibold">Barang Bukti:</h4>
                                        <p class="text-gray-700">{{ $barangBukti->barang_bukti }}</p>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="text-md font-semibold">Lokasi:</h4>
                                        <p class="text-gray-700">{{ $barangBukti->lokasi_barang_bukti }}</p>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="text-md font-semibold">Status:</h4>
                                        @if ($barangBukti->status === null)
                                            <p class="text-red-500">Belum diambil</p>
                                        @elseif ($barangBukti->status === 'Proses')
                                            <p class="text text-success">{{ $barangBukti->status }}</p>
                                        @else
                                            <p class="text text-primary">{{ $barangBukti->status }}</p>
                                        @endif
                                    </div>
                                    <div class="">
                                        <h4 class="text-md font-semibold">Foto:</h4>
                                        <img src="{{ asset('public/foto_barang_bukti/' . $barangBukti->foto_barang_bukti) }}"
                                            alt="Foto Barang Bukti" class="w-full h-auto mb-3">
                                    </div>
                                    @if ($barangBukti->status === 'Selesai')
                                        <div>
                                            <a href="{{ route('download.berita_acara', $barangBukti->id) }}"
                                                style="text-decoration: underline; color: blue;">
                                                Download Berita Acara Serah Terima
                                            </a>
                                            <a href="{{ route('download.dokumentasi', $barangBukti->id) }}"
                                                style="text-decoration: underline; color: blue;">
                                                Download Dokumentasi Serah Terima
                                            </a>
                                        </div>
                                    @endif

                                    @if ($barangBukti->pengambilanBarangBuktis->isEmpty())
                                        <x-button href="{{ route('barang-bukti.edit', $barangBukti->id) }}"
                                            class="btn btn-primary mt-4">
                                            Edit Barang Bukti
                                        </x-button>
                                    @endif
                                    @if ($barangBukti->pengambilanBarangBuktis->isNotEmpty())
                                        <x-button
                                            href="{{ route('permohonan-pengambilan.show', $barangBukti->pengambilanBarangBuktis->first()->id) }}"
                                            class="btn btn-warning mt-4">
                                            Lihat Permohonan
                                        </x-button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    @endif
                    <x-button href="{{ route('barang-bukti.create', ['dataPerkara' => $dataPerkara->id]) }}"
                        class="btn btn-primary mt-6">
                        Tambah Barang Bukti
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
