<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kebijakan Privasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="mb-6">
                <a href="{{ route('kebijakan_privasis.create') }}" class="btn btn-primary">
                    {{ __('Add Kebijakan Privasi') }}
                </a>
            </div> --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($kebijakanPrivasis as $kebijakanPrivasi)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $kebijakanPrivasi->judul }}</h3>
                            <p class="mt-2 text-sm text-gray-600">{{ $kebijakanPrivasi->isi }}</p>
                        </div>
                        <div class="bg-gray-100 px-4 py-2">
                            <a href="{{ route('kebijakan_privasis.edit', $kebijakanPrivasi->id) }}"
                                class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                            <div>
                                <a href="{{ route('kebijakan_privasis.show') }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900">{{ __('Lihat') }}</a>
                            </div>


                            {{-- <form class="inline-block"
                                action="{{ route('kebijakan_privasis.destroy', $kebijakanPrivasi->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                            </form> --}}
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
