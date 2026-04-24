<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Location
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('locations.update', $location->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- NAME FIELD --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                            name="name" :value="old('name', $location->name)"
                            oninput="generateSlug()" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- SLUG FIELD --}}
                    <div class="mt-4">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" class="block mt-1 w-full" type="text"
                            name="slug" :value="old('slug', $location->slug)" required />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    {{-- PARENT LOCATION DROPDOWN --}}
                    <div class="mt-4">
                        <x-input-label for="parent_id" :value="__('Parent Location')" />
                        <select name="parent_id" id="parent_id" class="block mt-1 w-full border-gray-300 rounded-md">
                            <option value="">No Parent</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}"
                                    {{ $location->parent_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUBMIT AND BACK --}}
                    <div class="mt-4 flex items-center">
                        <x-primary-button>
                            {{ __('Update Location') }}
                        </x-primary-button>

                        <a href="{{ route('locations.index') }}" class="ml-4 text-gray-600">
                            Back to list
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slug = name
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^a-z0-9-]/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>

</x-app-layout>