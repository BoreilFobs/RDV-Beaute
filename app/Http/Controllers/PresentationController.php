<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offers;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $offers = Offers::all();
        return view('prestations', compact("offers", "categories"));
    }

  
}
