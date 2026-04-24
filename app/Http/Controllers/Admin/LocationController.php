<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.locations.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|unique:locations,slug',
            'parent_id' => 'nullable|exists:locations,id',
        ]);

        Location::create([
            'name'      => $request->name,
            'slug'      => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        $locations = Location::all();
        return view('admin.locations.edit', compact('location', 'locations'));
    }

    public function update(Request $request, string $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|unique:locations,slug,' . $id,
            'parent_id' => 'nullable|exists:locations,id',
        ]);

        $location->update([
            'name'      => $request->name,
            'slug'      => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully');
    }

    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully');
    }
}