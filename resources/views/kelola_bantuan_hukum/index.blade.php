<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bantuan Hukum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Bantuan Hukum</h3>

                @if ($bantuanHukum->isEmpty())
                    <p>Tidak ada data bantuan hukum.</p>
                @else
                    <livewire:show-entries-dropdown :entries="$entries" />
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Instansi</th>
                                <th>Perihal Permohonan</th>
                                <th>File Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentPage = $bantuanHukum->currentPage();
                                $perPage = $bantuanHukum->perPage();
                                $startNumber = ($currentPage - 1) * $perPage + 1;
                            @endphp
                            @foreach ($bantuanHukum as $bantuan)
                                <tr>
                                    <td>{{ $startNumber++ }}</td>
                                    <td>{{ $bantuan->user->name }}</td>
                                    <td>{{ $bantuan->instansi }}</td>
                                    <td>{{ $bantuan->perihal }}</td>
                                    <td>
                                        <a href="{{ asset('files/bantuanhukum/' . $bantuan->unggah_file) }}"
                                            target="_blank"
                                            class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Lihat
                                            File</a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('files/bantuanhukum/' . $bantuan->unggah_file) }}"
                                            class="btn btn-success" download>Unduh File</a>
                                        <form action="{{ route('kelola_bantuan_hukum.destroy', $bantuan) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-danger-button type="submit">Hapus</x-jet-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <!-- Tampilkan Link Paginasi -->
                    {{ $bantuanHukum->links() }}

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
