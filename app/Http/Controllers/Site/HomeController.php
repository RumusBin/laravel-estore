<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::with('images')->get();

        return view('site.home', ['categories'=>$categories, 'brands'=>$brands, 'products'=>$products]);
    }
}
