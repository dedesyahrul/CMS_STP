<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload File Surat Kuasa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Surat Kuasa</h3>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($suratKuasa->isEmpty())
                    <p>Tidak ada data surat kuasa.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Path</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKuasa as $index => $surat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $surat->file_name }}</td>
                                    <td>{{ 'public/' . $surat->file_path }}</td>
                                    <td>
                                        <a href="{{ asset('public/' . $surat->file_path) }}" target="_blank"
                                            class="btn btn-primary">Lihat</a>
                                        <a href="{{ asset('public/' . $surat->file_path) }}" class="btn btn-success"
                                            download>Unduh</a>
                                        <a href="{{ route('surat_kuasa.edit', $surat->id) }}"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
