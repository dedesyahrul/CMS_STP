<x-app-layout>
    @livewireStyles

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Data Perkara') }}
            </h2>
            {{-- <a href="{{ route('surat_kuasa.index') }}" class="btn btn-sm btn-secondary">Upload File Surat Kuasa</a> --}}
            <a href="{{ route('data-perkaras.create') }}" class="btn btn-sm btn-info">Create</a>
        </div>
    </x-slot>
    <div class="container">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Daftar Data Perkara</h3>
                        <div>
                            <label for="entries" class="mr-2">Show entries:</label>
                            <select id="entries" name="entries" onchange="location = this.value;">
                                <option value="{{ request()->fullUrlWithQuery(['entries' => 10]) }}"
                                    {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                <option value="{{ request()->fullUrlWithQuery(['entries' => 25]) }}"
                                    {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                <option value="{{ request()->fullUrlWithQuery(['entries' => 50]) }}"
                                    {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                <option value="{{ request()->fullUrlWithQuery(['entries' => 100]) }}"
                                    {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No. Putusan Perkara</th>
                                <th scope="col">Tanggal Putusan</th>
                                <th scope="col">Nama Tersangka</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPerkaras as $dataPerkara)
                                <tr>
                                    <td>{{ $dataPerkara->no_putusan_perkara }}</td>
                                    <td>{{ $dataPerkara->tanggal_putusan }}</td>
                                    <td>{{ $dataPerkara->nama_tersangka }}</td>
                                    <td>
                                        <a href="{{ route('data-perkaras.show', $dataPerkara->id) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        <form action="{{ route('data-perkaras.destroy', $dataPerkara->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-button type="submit" class="btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Delete</x-jet-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $dataPerkaras->appends(['entries' => request('entries')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>
