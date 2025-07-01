<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = \App\Models\Gallery::all();
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view("admin.gallery.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
        ]);

        try {
            // Store the image in the public disk (you can change to s3 or other disks)
            $path = $request->file('image')->store('gallery', 'public');
            
            // Create gallery record with the image URL
            $gallery = Gallery::create([
                'img_url' => Storage::url($path),
            ]);

            return redirect()->route('gallery.index')
                ->with('success', 'Image uploaded successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error uploading image: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
         try {
            $gallery = Gallery::findOrFail($id);
            
            // Extract the path from the URL (remove the domain part)
            $path = parse_url($gallery->img_url, PHP_URL_PATH);
            $filePath = str_replace('/storage/', '', $path);
            
            // Delete the file from storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            
            // Delete the database record
            $gallery->delete();

            return redirect()->route('gallery.index')
                ->with('success', 'Image deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }
}
