<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiles') }}
        </h2>
        <a href="{{ route('profiles.create') }}" class="btn btn-primary">Add Profile</a>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">List of Profiles</h3>

                @if ($profiles->isEmpty())
                    <p>No profiles found.</p>
                @else
                    <ul>
                        @foreach ($profiles as $profile)
                            <li>
                                <h4 class="text-lg font-bold">{{ $profile->user->name }}</h4>
                                <p class="text-gray-600">{{ $profile->address }}</p>
                                <p class="text-gray-600">{{ $profile->phone }}</p>

                                @if ($profile->profile_image)
                                    <img src="{{ asset('images/' . $profile->profile_image) }}" alt="Profile Image" class="w-24 h-24 rounded-full">
                                @else
                                    <span class="text-gray-500">No profile image available</span>
                                @endif

                                <a href="{{ route('profiles.edit', $profile) }}" class="text-blue-600">Edit</a>

                                <form action="{{ route('profiles.destroy', $profile) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this profile?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-2">Delete</button>
                                </form>


                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
