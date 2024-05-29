<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Educations') }}
        </h2>
        <a href="{{ route('educations.create') }}" class="btn btn-primary">Add Education</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">List of Educations</h3>

                @if ($educations->isEmpty())
                    <p>No educations found.</p>
                @else
                    <ul>
                        @foreach ($educations as $education)
                            <li>
                                <h4 class="text-lg font-bold">{{ $education->institution }}</h4>
                                <p>{{ $education->degree }}</p>
                                <p>{{ $education->major }}</p>
                                {{-- <p>{{ $education->start_year }} - {{ $education->end_year ?? 'Present' }}</p> --}}
                                <p>{{ $education->start_year->format('Y') }} - {{ $education->end_year ? $education->end_year->format('Y') : 'Present' }}</p>
                                <div>
                                    <a href="{{ route('educations.edit', $education) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('educations.destroy', $education) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
