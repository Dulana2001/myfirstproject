<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    {{-- NAME FIELD --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                            name="name" :value="old('name')"
                            oninput="generateSlug()" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- SLUG FIELD --}}
                    <div class="mt-4">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" class="block mt-1 w-full" type="text"
                            name="slug" :value="old('slug')" required />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    {{-- PARENT CATEGORY DROPDOWN --}}
                    <div class="mt-4">
                        <x-input-label for="parent_id" :value="__('Parent Category')" />
                        <select name="parent_id" id="parent_id" class="block mt-1 w-full border-gray-300 rounded-md">
                            <option value="">No Parent</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- IS ACTIVE CHECKBOX --}}
                    <div class="mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ms-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>

                    {{-- SUBMIT AND BACK --}}
                    <div class="mt-4 flex items-center">
                        <x-primary-button>
                            {{ __('Save Category') }}
                        </x-primary-button>

                        <a href="{{ route('categories.index') }}" class="ml-4 text-gray-600">
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