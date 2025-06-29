<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $offers = Offers::all();
        return view('admin.offer.index', compact('offers'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.offer.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'duration' => 'required|integer|min:5',
            'cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgPath = null;

        if ($request->hasFile('img_path')) {
            try {
                $imgPath = $request->file('img_path')->store('offers', 'public');
            } catch (\Exception $e) {
                Log::error("Error uploading offer image: " . $e->getMessage());
                return back()->withInput()->with('error', 'Failed to upload image. Please try again.');
            }
        }

        try {
            Offers::create([
                'name' => $validatedData['name'],
                'category_id' => $validatedData['category_id'],
                'duration' => $validatedData['duration'],
                'cost' => $validatedData['cost'],
                'description' => $validatedData['description'] ?? null,
                'img_path' => $imgPath,
            ]);

            return redirect()->route('offers.index')->with('success', 'Offer created successfully!');
        } catch (\Exception $e) {
            Log::error("Error creating offer: " . $e->getMessage());
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
            return back()->withInput()->with('error', 'Failed to create offer. Please try again.');
        }
    }
    public function edit($id)
    {
        $categories = Category::all();
        $offer = Offers::findOrFail($id);
        return view('admin.offer.edit', compact('offer', "categories"));
    }

    public function update(Request $request, $id)
    {
        $offer = Offers::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
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
            'category_id' => $validatedData['category_id'],
            'duration' => $validatedData['duration'],
            'cost' => $validatedData['cost'],
            'description' => $validatedData['description'] ?? null,
            'img_path' => $imgPath,
        ]);

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    public function destroy($id)
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
