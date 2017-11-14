<?php
/**
 * Created by PhpStorm.
 * User: Rumus
 * Date: 07.11.2017
 * Time: 13:56
 */

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductsImages;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $data['product'] = Product::where('slug',$slug)->first();
        $data['images'] = ProductsImages::where('product_id', $data['product']['id'])->get();
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();

        return view('site.product.show', $data);
    }

}