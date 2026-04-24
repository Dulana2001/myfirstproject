@use('Illuminate\Support\Facades\Storage')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>firstproject - Buy & Sell in Sri Lanka</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm py-4 px-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
            firstproject
        </a>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('advertisements.index') }}" class="text-gray-600">My Ads</a>
                <a href="{{ route('advertisements.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Post Ad
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                <a href="{{ route('register') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Register
                </a>
            @endauth
        </div>
    </nav>

    {{-- SEARCH BAR --}}
    <div class="bg-blue-600 py-8 px-6">
        <form method="GET" action="{{ route('home') }}"
              class="max-w-4xl mx-auto">
            <div class="flex gap-2">
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Search for anything..."
                       class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-blue-300">
                <button type="submit"
                        class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold">
                    Search
                </button>
            </div>

            {{-- FILTERS --}}
            <div class="flex gap-2 mt-3">
                <select name="category_id"
                        class="px-3 py-2 rounded-lg border-0 text-sm flex-1">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="location_id"
                        class="px-3 py-2 rounded-lg border-0 text-sm flex-1">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}"
                            {{ request('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="min_price"
                       value="{{ request('min_price') }}"
                       placeholder="Min Price"
                       class="px-3 py-2 rounded-lg border-0 text-sm flex-1">

                <input type="number" name="max_price"
                       value="{{ request('max_price') }}"
                       placeholder="Max Price"
                       class="px-3 py-2 rounded-lg border-0 text-sm flex-1">

                @if(request()->hasAny(['search', 'category_id', 'location_id', 'min_price', 'max_price']))
                    <a href="{{ route('home') }}"
                       class="bg-white text-gray-600 px-4 py-2 rounded-lg text-sm">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- ADS GRID --}}
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Results count --}}
        <p class="text-gray-600 mb-4">
            {{ $advertisements->total() }} ads found
        </p>

        @if($advertisements->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($advertisements as $ad)
                    <a href="{{ route('advertisements.show', $ad->id) }}"
                       class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">

                        {{-- Image --}}
                        @if($ad->primaryImage)
                            <img src="{{ Storage::url($ad->primaryImage->file_path) }}"
                                 class="w-full h-40 object-cover"
                                 alt="{{ $ad->title }}">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-sm">No image</span>
                            </div>
                        @endif

                        {{-- Details --}}
                        <div class="p-3">
                            <h3 class="font-medium text-gray-900 truncate">{{ $ad->title }}</h3>
                            <p class="text-blue-600 font-semibold mt-1">
                                LKR {{ number_format($ad->price) }}
                                @if($ad->is_negotiable)
                                    <span class="text-xs text-gray-500">(Neg)</span>
                                @endif
                            </p>
                            <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                                <span>{{ $ad->category->name }}</span>
                                <span>{{ $ad->location->name }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $ad->created_at->diffForHumans() }}
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $advertisements->appends(request()->query())->links() }}
            </div>

        @else
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">No ads found.</p>
                @if(request()->hasAny(['search', 'category_id', 'location_id']))
                    <a href="{{ route('home') }}" class="text-blue-500 mt-2 inline-block">
                        Clear filters
                    </a>
                @endif
            </div>
        @endif

    </div>

</body>
</html>