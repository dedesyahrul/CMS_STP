<x-app-layout>
    <x-slot name="header">
        <x-jet-nav-link href="{{ route('image.index') }}" :active="request()->routeIs('image.index')">
            {{ __('Images Slider') }}
        </x-jet-nav-link>
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Gambar') }}
        </h2>
        <a href="{{ route('image.create') }}" class="btn btn-primary">Tambah Gambar</a> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Gambar</h3>

                @if ($images->isEmpty())
                    <p>Tidak ada data gambar.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Gambar</th>
                                {{-- <th>Link</th>
                                <th>Description</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $key => $image)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('public/file/imageslider/' . $image->image) }}"
                                            alt="Gambar {{ $key + 1 }}" class="h-16 w-16 object-cover">
                                    </td>
                                    {{-- <td>{{ $image->link }}</td>
                                    <td>{{ $image->description }}</td> --}}
                                    <td>
                                        <a href="{{ route('image.edit', $image->id) }}" class="btn btn-primary">Edit</a>
                                        {{-- <form action="{{ route('image.destroy', $image->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $images->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
