<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post New Advertisement
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('advertisements.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- TITLE --}}
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text"
                            name="title" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            rows="5" required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- PRICE --}}
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price (LKR)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number"
                            name="price" :value="old('price')" min="0" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    {{-- IS NEGOTIABLE --}}
                    <div class="mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_negotiable" value="1"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ms-2 text-sm text-gray-600">Price is negotiable</span>
                        </label>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="block mt-1 w-full border-gray-300 rounded-md">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->parent ? $category->parent->name . ' → ' : '' }}{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    {{-- LOCATION --}}
                    <div class="mt-4">
                        <x-input-label for="location_id" :value="__('Location')" />
                        <select name="location_id" id="location_id"
                            class="block mt-1 w-full border-gray-300 rounded-md">
                            <option value="">Select a location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->parent ? $location->parent->name . ' → ' : '' }}{{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                    </div>

                    {{-- IMAGES --}}
                    <div class="mt-4">
                        <x-input-label for="images" :value="__('Images (max 5)')" />
                        <input type="file" name="images[]" id="images"
                               multiple accept="image/*"
                               class="block mt-1 w-full text-sm text-gray-500" />
                        <p class="text-sm text-gray-500 mt-1">You can upload up to 5 images. First image will be the cover photo.</p>
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                    </div>

                    {{-- SUBMIT --}}
                    <div class="mt-6 flex items-center">
                        <x-primary-button>
                            {{ __('Post Advertisement') }}
                        </x-primary-button>
                        <a href="{{ route('advertisements.index') }}" class="ml-4 text-gray-600">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>