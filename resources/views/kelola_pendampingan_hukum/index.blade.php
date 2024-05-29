<x-app-layout>
    <x-slot name="header">
        <x-jet-nav-link href="{{ route('kelola_pendampingan_hukum.index') }}" :active="request()->routeIs('kelola_pendampingan_hukum.index')">
            {{ __('Pendampingan Hukum') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('kelola_pendapat_hukum.index') }}" :active="request()->routeIs('kelola_pendapat_hukum.index')">
            {{ __('Pendapat Hukum') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('kelola_audit_hukum.index') }}" :active="request()->routeIs('kelola_audit_hukum.index')">
            {{ __('Audit Hukum') }}
        </x-jet-nav-link>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Pendampingan Hukum</h3>

                @if ($pendampinganHukum->isEmpty())
                    <p>Tidak ada data pendampingan hukum.</p>
                @else
                    {{-- <livewire:show-entries-dropdown :entries="$entries" /> --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Instansi</th>
                                <th>Perihal Permohonan</th>
                                <th>Surat Permohonan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentPage = $pendampinganHukum->currentPage();
                                $perPage = $pendampinganHukum->perPage();
                                $startNumber = ($currentPage - 1) * $perPage + 1;
                            @endphp
                            @foreach ($pendampinganHukum as $p)
                                <tr>
                                    <td>{{ $startNumber++ }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->instansi }}</td>
                                    <td>{{ $p->perihal }}</td>
                                    <td>
                                        <a href="{{ asset('files/pendampinganhukum/' . $p->unggah_file) }}"
                                            target="_blank"
                                            class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Lihat
                                            File</a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('files/pendampinganhukum/' . $p->unggah_file) }}"
                                            class="btn btn-success" download>Unduh File</a>
                                        <form action="{{ route('kelola_pendampingan_hukum.destroy', $p) }}"
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
                    {{ $pendampinganHukum->links() }}

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
