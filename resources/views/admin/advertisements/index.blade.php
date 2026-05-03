<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pending Advertisements 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Posted by</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $ad)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->category->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">LKR {{ number_format($ad->price) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $ad->created_at->format('d M Y') }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('admin.advertisements.show', $ad->id) }}"
                                       class="text-blue-500">Review</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    No pending ads.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>