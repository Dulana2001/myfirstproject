<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Locations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('locations.create') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded">
                        Add New Location
                    </a>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Slug</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Parent</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $location->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $location->slug }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $location->parent?->name ?? 'None' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('locations.edit', $location->id) }}"
                                       class="text-blue-500 mr-2">Edit</a>

                                    <form action="{{ route('locations.destroy', $location->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    No locations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>