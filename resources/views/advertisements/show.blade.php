@use('Illuminate\Support\Facades\Storage')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $advertisement->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- IMAGES --}}
                @if($advertisement->images->count() > 0)
                    <div class="flex gap-2 mb-6 overflow-x-auto">
                        @foreach($advertisement->images as $image)
                            <img src="{{ Storage::url($image->file_path) }}"
                                 class="h-48 w-48 object-cover rounded"
                                 alt="{{ $advertisement->title }}">
                        @endforeach
                    </div>
                @else
                    <div class="mb-6 bg-gray-100 h-48 flex items-center justify-center rounded">
                        <span class="text-gray-400">No images uploaded</span>
                    </div>
                @endif

                {{-- DETAILS --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="font-medium">{{ $advertisement->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Location</p>
                        <p class="font-medium">{{ $advertisement->location->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Price</p>
                        <p class="font-medium">LKR {{ number_format($advertisement->price) }}
                            @if($advertisement->is_negotiable)
                                <span class="text-sm text-gray-500">(Negotiable)</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="px-2 py-1 rounded text-sm
                            {{ $advertisement->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $advertisement->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $advertisement->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $advertisement->status === 'sold' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ ucfirst($advertisement->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Posted by</p>
                        <p class="font-medium">{{ $advertisement->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Posted on</p>
                        <p class="font-medium">{{ $advertisement->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-1">Description</p>
                    <p class="text-gray-700">{{ $advertisement->description }}</p>
                </div>

                {{-- ACTIONS --}}
                <div class="flex gap-4">
                    <a href="{{ route('advertisements.edit', $advertisement->id) }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded">
                        Edit
                    </a>
                    <a href="{{ route('advertisements.index') }}"
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                        Back to My Ads
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>