<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductsImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product;

//        $params = [
////            'title' => 'Products Listing',
//            'products' => $products,
//        ];
        return view('admin.products.products_list', ['products'=>$products->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = Category::all();
        $params = [
            'title' => 'Create Product',
            'brands' => $brands,
            'categories' => $categories,

        ];
        return view('admin.products.products_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $this->validate($request, [
            'product_code' => 'required|unique:products',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::create([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
        ]);

        if($request->hasFile('images')){
            $last_product = Product::orderBy('id', 'desc')->first();
            $product_id = $last_product->id;

            foreach ($request->images as $image){

                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move('images/products', $imageName);
                        $imagePath = '/images/products/'.$imageName;
                       $imageModel = new ProductsImages;
                       $imageModel->image_path = $imagePath;
                       $imageModel->product_id = $product_id;
                       $imageModel->save();
            }
        }
                return redirect()->route('products.index')->with('success', "The product <strong>Product name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $product = Product::findOrFail($id);
            $params = [
                'title' => 'Delete Product',
                'product' => $product,
            ];
            return view('admin.products.products_delete')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            $brands = Brand::all();
            $categories = Category::all();
            $product = Product::findOrFail($id);
            $images = ProductsImages::where('product_id', $id)->get();
            $params = [
                'title' => 'Edit Product',
                'brands' => $brands,
                'categories' => $categories,
                'product' => $product,
                'images' => $images
            ];
            return view('admin.products.products_edit')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'product_code' => 'required|unique:products,product_code,'.$id,
                'product_name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
            ]);
            $product = Product::findOrFail($id);
            $product->product_code = $request->input('product_code');
            $product->product_name = $request->input('product_name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->brand_id = $request->input('brand_id');
            $product->category_id = $request->input('category_id');
            $product->save();
            return redirect()->route('products.index')->with('success', "The product <strong>$product->name</strong> has successfully been updated.");
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('products.index')->with('success', "The product <strong>$product->product_name</strong> has successfully been archived.");
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function newImagesUpload($productId, Request $request)
    {

        try
        {
            $this->validate($request, [
                'file'=> 'mimes:jpeg,jpg,png'
            ]);

            $image = new ProductsImages();

            $images = $request->file('file');
            if($images){
                $imagesName = time() . '_' . $images->getClientOriginalName();
                $images->move('images/products', $imagesName);
                $imagePath = 'images/products/'.$imagesName;

                $image->image_path = $imagePath;
                $image->product_id = $productId;
                $image->save();
            }

        }catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }


    }
}
