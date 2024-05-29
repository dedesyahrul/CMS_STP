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
                <h3 class="text-lg font-bold mb-4">Upload Surat Kuasa</h3>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada masalah dengan file yang Anda unggah.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('surat_kuasa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <x-jet-input type="file" name="file" class="form-control" />
                    </div>
                    <x-jet-button>
                        Unggah
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
