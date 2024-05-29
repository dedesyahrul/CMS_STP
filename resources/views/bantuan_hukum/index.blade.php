<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bantuan Hukum') }}
        </h2>
        <a href="{{ route('bantuan_hukum.create') }}" class="btn btn-primary">Add Bantuan Hukum</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @if ($bantuanHukum->where('user_id', auth()->user()->id)->isEmpty())
                    <p>No bantuan hukum found.</p>
                @else
                    @foreach ($bantuanHukum as $bantuan)
                        @if ($bantuan->user_id == auth()->user()->id)
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                                <h3 class="text-lg font-bold mb-4">Nama: {{ $bantuan->user->name }}</h3>
                                <p>Nama Instansi: {{ $bantuan->instansi }}</p>
                                <p>Perihal Permohonan: {{ $bantuan->perihal }}</p>
                                <p>Unggah File:
                                    <a href="{{ asset('files/bantuanhukum/' . $bantuan->unggah_file) }}" target="_blank"
                                        class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Lihat
                                        File</a>
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('bantuan_hukum.edit', $bantuan) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('bantuan_hukum.destroy', $bantuan) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button type="submit">Hapus</x-jet-danger-button>
                                    </form>
                                    <a href="{{ asset('files/bantuanhukum/' . $bantuan->unggah_file) }}"
                                        class="btn btn-success" download>Unduh File</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
