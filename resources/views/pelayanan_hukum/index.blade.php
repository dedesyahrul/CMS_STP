<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelayanan Hukum') }}
        </h2>
        <a href="{{ route('pelayanan_hukum.create') }}" class="btn btn-primary">Add Pelayanan Hukum</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">List of Pelayanan Hukum</h3>

                @if ($pelayananHukum->isEmpty())
                    <p>No pelayanan hukum found.</p>
                @else
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($pelayananHukum as $ph)
                            @if ($ph->user_id == auth()->user()->id)
                                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                                    <div class="p-6">
                                        <h4 class="text-lg font-bold">ID: {{ $ph->id_pelayanan_hukum }}</h4>
                                        <p>NIK: {{ $ph->nik }}</p>
                                        <p>Nama: {{ $ph->nama }}</p>
                                        <p>Pertanyaan: {{ $ph->pertanyaan }}</p>
                                        <p>Nomor HP: {{ $ph->nomor_hp }}</p>
                                    </div>
                                    <div class="p-6 bg-gray-100 border-t border-gray-200">
                                        <div class="flex justify-end">
                                            <x-jet-secondary-button href="{{ route('pelayanan_hukum.edit', $ph) }}">Edit
                                            </x-jet-secondary-button>
                                            <form action="{{ route('pelayanan_hukum.destroy', $ph) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-jet-danger-button type="submit">Delete</x-jet-danger-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
