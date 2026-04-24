<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Advertisements
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('advertisements.create') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded">
                        Post New Ad
                    </a>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $ad)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->category->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">LKR {{ number_format($ad->price) }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="px-2 py-1 rounded text-sm
                                        {{ $ad->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $ad->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $ad->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $ad->status === 'sold' ? 'bg-gray-100 text-gray-700' : '' }}">
                                        {{ ucfirst($ad->status) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('advertisements.show', $ad->id) }}"
                                       class="text-blue-500 mr-2">View</a>
                                    <a href="{{ route('advertisements.edit', $ad->id) }}"
                                       class="text-green-500 mr-2">Edit</a>
                                    <form action="{{ route('advertisements.destroy', $ad->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    You haven't posted any ads yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>