<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function index()
    {
        $offers = Offers::all();
        return view('admin.prestations.index', compact('offers'));
    }
    public function create()
    {
        return view('admin.prestations.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'duration' => 'required|integer|min:5',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        $imgPath = null;

        // 2. Handle image upload if present
        if ($request->hasFile('img_path')) {
            try {
                // Store the image in the 'public' disk under the 'offers' directory
                // and get the path. Laravel's store() method generates a unique filename.
                $imgPath = $request->file('img_path')->store('offers', 'public');
            } catch (\Exception $e) {
                Log::error("Error uploading offer image: " . $e->getMessage());
                // Optionally, redirect back with an error message
                return back()->withInput()->with('error', 'Failed to upload image. Please try again.');
            }
        }

        // 3. Create a new Offer instance and save to database
        try {
            Offers::create([
                'name' => $validatedData['name'],
                'category' => $validatedData['category'],
                'duration' => $validatedData['duration'],
                'cost' => $validatedData['cost'],
                'description' => $validatedData['description'] ?? null, // Use null if description is not provided
                'img_path' => $imgPath, // Store the generated path
            ]);

            // 4. Redirect with a success message
            return redirect()->route('offers.index')->with('success', 'Offer created successfully!');
        } catch (\Exception $e) {
            Log::error("Error creating offer: " . $e->getMessage());
            // If an image was uploaded, delete it to prevent orphaned files
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
            return back()->withInput()->with('error', 'Failed to create offer. Please try again.');
        }
    }
    public function edit($id)
    {
        $offer = Offers::findOrFail($id);
        return view('offers.edit', compact('offer'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offers::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'duration' => 'required|integer|min:5',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgPath = $offer->img_path; // Keep existing path by default

        if ($request->hasFile('img_path')) {
            // Delete old image if it exists
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
            $imgPath = $request->file('img_path')->store('offers', 'public');
        }

        $offer->update([
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'duration' => $validatedData['duration'],
            'cost' => $validatedData['cost'],
            'description' => $validatedData['description'] ?? null,
            'img_path' => $imgPath,
        ]);

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    public function delete($id)
    {
        $offer = Offers::findOrFail($id);

        // Delete the associated image file if it exists
        if ($offer->img_path) {
            Storage::disk('public')->delete($offer->img_path);
        }

        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully!');
    }
}
