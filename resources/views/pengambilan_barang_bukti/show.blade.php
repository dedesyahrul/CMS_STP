<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Detail Permohonan Pengambilan Barang Bukti') }}
            </h2>
            <x-jet-button onclick="window.location='{{ route('data-perkaras.show', $barangBukti->data_perkara_id) }}'">
                Back
            </x-jet-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold">Detail Permohonan Pengambilan Barang Bukti</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <x-jet-label class="text-lg font-bold">Nama Tersangka:</x-jet-label>
                        <p>{{ $permohonan->nama_tersangka }}</p>
                    </div>
                    <div>
                        <x-jet-label class="text-lg font-bold">Nama Pengambil:</x-jet-label>
                        <p>{{ $permohonan->nama_pengambil_barang_bukti }}</p>
                    </div>
                    <div>
                        <x-jet-label class="text-lg font-bold">Nomor HP:</x-jet-label>
                        <p>{{ $permohonan->nomor_hp }}</p>
                    </div>
                    <div>
                        <x-jet-label class="text-lg font-bold">Metode Pengambilan:</x-jet-label>
                        <p>{{ $permohonan->metode_pengambilan }}</p>
                    </div>

                    @if ($permohonan->metode_pengambilan == 'Ambil Sendiri')
                        <div>
                            <x-jet-label class="text-lg font-bold">Tanggal Pengambilan:</x-jet-label>
                            <p>{{ $permohonan->tanggal_pengantaran }}</p>
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Status:</x-jet-label>
                            @if ($barangBukti->status === null)
                                <span class="text-red-500">Belum diambil</span>
                            @else
                                <span class="text-blue-500">{{ $barangBukti->status }}</span>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Foto KTP/KK/SIM :</x-jet-label>
                            @if ($permohonan->foto_ktp_kk_sim)
                                <img src="{{ asset('public/uploads/ktp_kk_sim/' . $permohonan->foto_ktp_kk_sim) }}"
                                    alt="Foto KTP/KK/SIM Pembei Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Foto KTP/KK/SIM Penerima Kuasa:</x-jet-label>
                            @if ($permohonan->penerima_kuasa)
                                <img src="{{ asset('public/uploads/penerima_kuasa/' . $permohonan->penerima_kuasa) }}"
                                    alt="Foto KTP/KK/SIM Penerima Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Surat Kuasa:</x-jet-label>
                            @if ($permohonan->surat_kuasa)
                                <img src="{{ asset('public/uploads/surat_kuasa/' . $permohonan->surat_kuasa) }}"
                                    alt="Surat Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Dokumentasi Penerima Surat Kuasa:</x-jet-label>
                            @if ($permohonan->penerima_surat_kuasa)
                                <img src="{{ asset('public/uploads/penerima_surat_kuasa/' . $permohonan->penerima_surat_kuasa) }}"
                                    alt="Dokumentasi Penerima Surat Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                    @elseif ($permohonan->metode_pengambilan == 'Diantar')
                        <div>
                            <x-jet-label class="text-lg font-bold">Wilayah Pengantar:</x-jet-label>
                            <p>{{ $permohonan->wilayah_pengantar }}</p>
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Alamat Pengantaran:</x-jet-label>
                            <p>{{ $permohonan->alamat_pengantaran }}</p>
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Tanggal Pengantaran:</x-jet-label>
                            <p>{{ $permohonan->tanggal_pengantaran }}</p>
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Status:</x-jet-label>
                            @if ($barangBukti->status === null)
                                <span class="text-red-500">Belum diantar</span>
                            @else
                                <span class="text-blue-500">{{ $barangBukti->status }}</span>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Foto KTP/KK/SIM :</x-jet-label>
                            @if ($permohonan->foto_ktp_kk_sim)
                                <img src="{{ asset('public/uploads/ktp_kk_sim/' . $permohonan->foto_ktp_kk_sim) }}"
                                    alt="Foto KTP/KK/SIM Pembei Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Foto KTP/KK/SIM Penerima Kuasa:</x-jet-label>
                            @if ($permohonan->penerima_kuasa)
                                <img src="{{ asset('public/uploads/penerima_kuasa/' . $permohonan->penerima_kuasa) }}"
                                    alt="Foto KTP/KK/SIM Penerima Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Surat Kuasa:</x-jet-label>
                            @if ($permohonan->surat_kuasa)
                                <img src="{{ asset('public/uploads/surat_kuasa/' . $permohonan->surat_kuasa) }}"
                                    alt="Surat Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                        <div>
                            <x-jet-label class="text-lg font-bold">Dokumentasi Penerima Surat Kuasa:</x-jet-label>
                            @if ($permohonan->penerima_surat_kuasa)
                                <img src="{{ asset('public/uploads/penerima_surat_kuasa/' . $permohonan->penerima_surat_kuasa) }}"
                                    alt="Dokumentasi Penerima Surat Kuasa" class="object-cover w-48 h-48 rounded">
                            @else
                                <p>Tidak ada foto.</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex space-x-4">
                    <x-jet-button
                        onclick="window.location='{{ route('data-perkaras.show', $barangBukti->data_perkara_id) }}'">
                        Kembali
                    </x-jet-button>

                    @if ($barangBukti->status === 'Proses')
                        <a href="{{ route('selesai-pengambilan.show', $barangBukti->id) }}"
                            class="btn btn-sm btn-danger">
                            Selesaikan Pengambilan Barang Bukti
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
