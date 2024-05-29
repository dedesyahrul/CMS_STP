<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Form Pengambilan Barang Bukti') }}
            </h2>
            <x-jet-secondary-button>
                <a href="{{ route('data-perkaras.show', $barangBukti->data_perkara_id) }}">Back</a>
            </x-jet-secondary-button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('pengambilan-barang-bukti.store', $barangBukti->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-jet-label for="nama_tersangka" value="{{ __('Nama Tersangka') }}" />
                        <x-jet-input id="nama_tersangka" class="block w-full mt-1" type="text" name="nama_tersangka"
                            value="{{ $namaTersangka }}" readonly />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="nama_pengambil_barang_bukti"
                            value="{{ __('Nama Pengambil Barang Bukti') }}" />
                        <x-jet-input id="nama_pengambil_barang_bukti" class="block w-full mt-1" type="text"
                            name="nama_pengambil_barang_bukti" required />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="nomor_hp" value="{{ __('Nomor HP') }}" />
                        <x-jet-input id="nomor_hp" class="block w-full mt-1" type="text" name="nomor_hp" required />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="metode_pengambilan" value="{{ __('Metode Pengambilan') }}" />
                        <div class="flex items-center mt-2">
                            <x-jet-input id="diantar" class="mr-2" type="radio" name="metode_pengambilan"
                                value="Diantar" required />
                            <x-jet-label for="diantar" value="{{ __('Diantar') }}" />
                        </div>
                        <div class="flex items-center mt-2">
                            <x-jet-input id="ambil_sendiri" class="mr-2" type="radio" name="metode_pengambilan"
                                value="Ambil Sendiri" required />
                            <x-jet-label for="ambil_sendiri" value="{{ __('Ambil Sendiri') }}" />
                        </div>
                    </div>

                    <div id="diantar-fields" style="display: none;">
                        <div class="mb-4">
                            <x-jet-label for="wilayah_pengantar" value="{{ __('Wilayah Pengantar') }}" />
                            <select id="wilayah_pengantar" name="wilayah_pengantar" class="block w-full mt-1">
                                <option value="">{{ __('Pilih Wilayah Pengantar') }}</option>
                                @foreach ($wilayahPengantars as $wilayahPengantar)
                                    <option value="{{ $wilayahPengantar->nama }}">{{ $wilayahPengantar->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-jet-label for="alamat_pengantaran" value="{{ __('Alamat Pengantaran') }}" />
                            <textarea id="alamat_pengantaran" class="block w-full mt-1" name="alamat_pengantaran"></textarea>
                        </div>
                        <!-- Penerima Kuasa -->
                        <div class="flex-1 mb-4 ml-4">
                            <x-jet-label for="penerima_kuasa"
                                value="{{ __('Upload Foto KTP/KK/SIM Penerima Kuasa') }}" />
                            <x-jet-input id="penerima_kuasa" class="block w-full mt-1" type="file"
                                name="penerima_kuasa" />
                        </div>
                        <!-- Surat Kuasa -->
                        <div class="flex-1 mb-4 ml-4">
                            <x-jet-label for="surat_kuasa" value="{{ __('Upload Surat Kuasa') }}" />
                            <x-jet-input id="surat_kuasa" class="block w-full mt-1" type="file" name="surat_kuasa" />
                        </div>
                        <!-- Penerima Surat Kuasa -->
                        <div class="flex-1 mb-4 ml-4">
                            <x-jet-label for="penerima_surat_kuasa"
                                value="{{ __('Upload Dokumentasi Penerima Surat Kuasa') }}" />
                            <x-jet-input id="penerima_surat_kuasa" class="block w-full mt-1" type="file"
                                name="penerima_surat_kuasa" />
                        </div>
                    </div>

                    <div id="shared-fields" style="display: none;">
                        <div class="flex">
                            <!-- Tanggal Pengantaran -->
                            <div class="flex-1 mb-4">
                                <x-jet-label for="tanggal_pengantaran" value="{{ __('Tanggal Pengantaran') }}" />
                                <x-jet-input id="tanggal_pengantaran" class="block w-full mt-1" type="date"
                                    name="tanggal_pengantaran" />
                            </div>
                            <!-- Foto KTP KK SIM -->
                            <div class="flex-1 mb-4 ml-4">
                                <x-jet-label for="foto_ktp_kk_sim"
                                    value="{{ __('Upload Foto KTP/KK/SIM Pemberi Kuasa') }}" />
                                <x-jet-input id="foto_ktp_kk_sim" class="block w-full mt-1" type="file"
                                    name="foto_ktp_kk_sim" />
                            </div>

                        </div>
                    </div>

                    <x-jet-button type="submit">{{ __('Ajukan Permohonan Pengambilan') }}</x-jet-button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var diantarRadio = document.getElementById('diantar');
            var ambilSendiriRadio = document.getElementById('ambil_sendiri');
            var diantarFields = document.getElementById('diantar-fields');
            var sharedFields = document.getElementById('shared-fields');

            function toggleFields() {
                if (diantarRadio.checked) {
                    diantarFields.style.display = 'block';
                    sharedFields.style.display = 'block';
                } else if (ambilSendiriRadio.checked) {
                    diantarFields.style.display = 'none';
                    sharedFields.style.display = 'block';
                } else {
                    diantarFields.style.display = 'none';
                    sharedFields.style.display = 'none';
                }
            }

            diantarRadio.addEventListener('change', toggleFields);
            ambilSendiriRadio.addEventListener('change', toggleFields);

            // Initial call to set the correct fields visibility
            toggleFields();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ambilSendiriRadio = document.getElementById('ambil_sendiri');
            var tanggalPengantaranLabel = document.querySelector('label[for="tanggal_pengantaran"]');

            function toggleLabel() {
                if (ambilSendiriRadio.checked) {
                    tanggalPengantaranLabel.textContent = 'Tanggal Pengambilan';
                } else {
                    tanggalPengantaranLabel.textContent = 'Tanggal Pengantaran';
                }
            }

            ambilSendiriRadio.addEventListener('change', toggleLabel);

            // Panggil fungsi toggleLabel() secara initial untuk mengatur teks label yang benar
            toggleLabel();
        });
    </script>

</x-app-layout>
