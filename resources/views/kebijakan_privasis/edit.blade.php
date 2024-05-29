<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kebijakan Privasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <x-jet-validation-errors class="mb-4" />

                    <form action="{{ route('kebijakan_privasis.update', $kebijakanPrivasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="judul" value="{{ __('Judul') }}" />
                            <x-jet-input id="judul" type="text" class="mt-1 block w-full" name="judul"
                                value="{{ old('judul', $kebijakanPrivasi->judul) }}" autofocus />
                        </div>

                        <!-- Isi -->
                        <div class="col-span-6">
                            <x-jet-label for="isi" value="{{ __('Isi') }}" />
                            <textarea id="isi" class="mt-1 block w-full" rows="6" name="isi">
                                {{ old('isi', $kebijakanPrivasi->isi) }}
                            </textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
