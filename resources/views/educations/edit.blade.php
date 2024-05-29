<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Education') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('educations.update', $education->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="institution" value="Institution" />
                        <x-jet-input id="institution" type="text" class="mt-1 block w-full" name="institution" :value="old('institution', $education->institution)" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="degree" value="Degree" />
                        <x-jet-input id="degree" type="text" class="mt-1 block w-full" name="degree" :value="old('degree', $education->degree)" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="major" value="Major" />
                        <x-jet-input id="major" type="text" class="mt-1 block w-full" name="major" :value="old('major', $education->major)" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="start_year" value="Start Year" />
                        <x-jet-input id="start_year" type="date" class="mt-1 block w-full" name="start_year" :value="old('start_year', $education->start_year ? $education->start_year->format('Y-m-d') : null)" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="end_year" value="End Year" />
                        <x-jet-input id="end_year" type="date" class="mt-1 block w-full" name="end_year" :value="old('end_year', $education->end_year ? $education->end_year->format('Y-m-d') : null)" />
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
</x-app-layout>
