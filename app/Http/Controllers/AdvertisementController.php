<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Location;
use App\Models\AdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    /**
     * Show all ads for the logged in user
     */
    public function index()
    {
        $advertisements = Advertisement::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form to create a new ad
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $locations  = Location::all();

        return view('advertisements.create', compact('categories', 'locations'));
    }

    /**
     * Save the new ad to database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'price'         => 'required|numeric|min:0',
            'category_id'   => 'required|exists:categories,id',
            'location_id'   => 'required|exists:locations,id',
            'is_negotiable' => 'boolean',
            'images'        => 'nullable|array|max:5',
            'images.*'      => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Create the advertisement
        $advertisement = Advertisement::create([
            'user_id'       => Auth::id(),
            'category_id'   => $request->category_id,
            'location_id'   => $request->location_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . time(),
            'description'   => $request->description,
            'price'         => $request->price,
            'is_negotiable' => $request->boolean('is_negotiable'),
            'status'        => 'pending',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('advertisements', 'public');

                AdImage::create([
                    'advertisement_id' => $advertisement->id,
                    'file_path'        => $path,
                    'is_primary'       => $index === 0,
                    'sort_order'       => $index,
                ]);
            }
        }

        return redirect()->route('advertisements.index')
            ->with('success', 'Ad posted successfully! It will be reviewed shortly.');
    }

    /**
     * Show one full advertisement
     */
    public function show(string $id)
    {
        $advertisement = Advertisement::with(['category', 'location', 'images', 'user'])
            ->findOrFail($id);

        return view('advertisements.show', compact('advertisement'));
    }

    /**
     * Show the edit form
     */
    public function edit(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        // Only the owner can edit
        $this->authorize('update', $advertisement);

        $categories = Category::where('is_active', true)->get();
        $locations  = Location::all();

        return view('advertisements.edit', compact('advertisement', 'categories', 'locations'));
    }

    /**
     * Update the advertisement
     */
    public function update(Request $request, string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $this->authorize('update', $advertisement);

        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'price'         => 'required|numeric|min:0',
            'category_id'   => 'required|exists:categories,id',
            'location_id'   => 'required|exists:locations,id',
            'is_negotiable' => 'boolean',
            'images'        => 'nullable|array|max:5',
            'images.*'      => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $advertisement->update([
            'category_id'   => $request->category_id,
            'location_id'   => $request->location_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'is_negotiable' => $request->boolean('is_negotiable'),
            'status'        => 'pending',
        ]);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('advertisements', 'public');

                AdImage::create([
                    'advertisement_id' => $advertisement->id,
                    'file_path'        => $path,
                    'is_primary'       => $advertisement->images()->count() === 0 && $index === 0,
                    'sort_order'       => $advertisement->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('advertisements.index')
            ->with('success', 'Ad updated successfully! It will be reviewed again.');
    }

    /**
     * Delete the advertisement
     */
    public function destroy(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $this->authorize('delete', $advertisement);

        // Delete images from storage
        foreach ($advertisement->images as $image) {
            Storage::disk('public')->delete($image->file_path);
        }

        $advertisement->delete();

        return redirect()->route('advertisements.index')
            ->with('success', 'Ad deleted successfully.');
    }
}