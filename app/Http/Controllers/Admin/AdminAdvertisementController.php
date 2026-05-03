<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdminAdvertisementController extends Controller
{
    // List all pending ads
    public function index()
    {
        


        $advertisements = Advertisement::with(['user', 'category', 'location'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.advertisements.index', compact('advertisements'));
    }

    // Show one ad in detail
    public function show(string $id)
    {
        $advertisement = Advertisement::with(['user', 'category', 'location', 'images'])
            ->findOrFail($id);

        return view('admin.advertisements.show', compact('advertisement'));
    }

    // Approve the ad
    public function approve(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $advertisement->update([
            'status'       => 'active',
            'published_at' => now(),
        ]);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Ad approved successfully!');
    }

    // Reject the ad
    public function reject(Request $request, string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $advertisement->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Ad rejected.');
    }
}