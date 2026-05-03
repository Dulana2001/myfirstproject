<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Review Advertisement
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p><strong>Title:</strong> {{ $advertisement->title }}</p>
                <p><strong>Status:</strong> {{ $advertisement->status }}</p>
                <p><strong>Posted by:</strong> {{ $advertisement->user->name }}</p>

                <div class="flex gap-4 mt-6">
                    <form action="{{ route('admin.advertisements.approve', $advertisement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.advertisements.reject', $advertisement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded">
                            Reject
                        </button>
                    </form>

                    <a href="{{ route('admin.advertisements.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>