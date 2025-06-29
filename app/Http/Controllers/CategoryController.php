<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact('categories'));
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $imageUrl = '/storage/' . $imagePath;
        } else {
            $imageUrl = null;
        }

        Category::create([
            'name' => $request->input('name'),
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        // Display the specified resource.
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view("admin.category.edit" , compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $imageUrl = '/storage/' . $imagePath;
            $category->image_url = $imageUrl;
        }

        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Optionally, delete the image file from storage
        if ($category->image_url) {
            $imagePath = str_replace('/storage/', '', $category->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
