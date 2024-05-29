<x-app-layout>
    <x-slot name="header">
        <x-jet-nav-link href="{{ route('pendampingan_hukum.index') }}" :active="request()->routeIs('pendampingan_hukum.index')">
            {{ __('Pendampingan Hukum') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('pendapat_hukum.index') }}" :active="request()->routeIs('pendapat_hukum.index')">
            {{ __('Pendapat Hukum') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('audit_hukum.index') }}" :active="request()->routeIs('audit_hukum.index')">
            {{ __('Audit Hukum') }}
        </x-jet-nav-link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendampingan Hukum') }}
        </h2>
        <a href="{{ route('pendampingan_hukum.create') }}" class="btn btn-primary">Add Pendampingan Hukum</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @if ($pendampinganHukum->where('user_id', auth()->user()->id)->isEmpty())
                    <p>No pendampingan hukum found.</p>
                @else
                    @foreach ($pendampinganHukum as $p)
                        @if ($p->user_id == auth()->user()->id)
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                                <h3 class="text-lg font-bold mb-4">Nama: {{ $p->user->name }}</h3>
                                <p>Nama Instansi: {{ $p->instansi }}</p>
                                <p>Perihal Permohonan: {{ $p->perihal }}</p>
                                <p>Unggah File:
                                    <a href="{{ asset('files/pendampinganhukum/' . $p->unggah_file) }}" target="_blank"
                                        class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Lihat
                                        File</a>
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('pendampingan_hukum.edit', $p) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('pendampingan_hukum.destroy', $p) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button type="submit">Hapus</x-jet-danger-button>
                                    </form>
                                    <a href="{{ asset('files/pendampinganhukum/' . $p->unggah_file) }}"
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
