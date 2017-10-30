<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Config;

class HomeController extends Controller
{
    public function index()
    {


        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::with('images')->paginate(5);


        return view('site.home', ['categories'=>$categories, 'brands'=>$brands, 'products'=>$products]);
    }
}
