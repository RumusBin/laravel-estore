<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use File;
use Illuminate\Support\Facades\Session;


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
            //the first of the downloaded pictures will be the main one
            $firstImg = ProductsImages::where('product_id', '=',$product_id)->firstOrFail();
            $firstImg->is_main = 1;
            $firstImg->save();
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
            // find all pictures of this product
            $productImages = $product->images;

            if($productImages){
                //if the pictures are present, we go through each and delete from the database and from the server
                foreach ($productImages as $image){
                    File::delete(public_path().$image->image_path);
                    $image->delete();
                }
            }
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

    public function newImagesUpload($productId=false, Request $request)
    {
        $image = new ProductsImages();

        try
        {
            $this->validate($request, [
                'file'=> 'mimes:jpeg,jpg,png'
            ]);

            $images = $request->file('file');
            if($images){
                $imagesName = time() . '_' . $images->getClientOriginalName();
                $images->move('images/products', $imagesName);
                $imagePath = '/images/products/'.$imagesName;

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

    public function imageReload(Request $request)
    {

        $id = $request->input('itmId');
        $imgRow = ProductsImages::find($id);

        $oldFile = $imgRow->image_path;

        File::delete(public_path().$oldFile);

        $newImage = $request->file('img_new');
        if($newImage){
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move('images/products', $imageName);
            $imagePath = '/images/products/'.$imageName;
            $imgRow->image_path = $imagePath;
            $imgRow->save();
        }


     return  $request->file();
    }

    public function addNewImage(Request $request)
    {
        $image = new ProductsImages();


            try {
                $this->validate($request, [
                    'file'=> 'mimes:jpeg,jpg,png'
                ]);

                if ($request->input('product_id')) {
                    $productId = $request->input('product_id');
                    $newImage = $request->file('img_new');
                    $imageName = time() . '_' . $newImage->getClientOriginalName();
                    $newImage->move('images/products', $imageName);
                    $imagePath = '/images/products/' . $imageName;
                    $image->image_path = $imagePath;
                    $image->product_id = $productId;
                    $image->save();
                    return $imageName;
                }
            }catch(ModelNotFoundException $ex){
                return response()->view('errors.'.'404');
            }
    }

    public function deleteImage($id)
    {

        $image = ProductsImages::find($id);

        $imgFile = $image->image_path;

        File::delete(public_path().$imgFile);

        $image->delete();

        return "Done";
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
//        dd(session::get('cart'));
        return redirect()->back();
    }

    public function showCart()
    {
        if(!Session::has('cart'))
        {
            return view('site.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $data['products'] = $cart->items;
        $data['totalPrice'] = $cart->totalPrice;

        return view('site.shopping-cart', $data);
    }

    public function deleteFromCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function removeAll(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getCheckout()
    {
        if(!Session::has('cart')){
            redirect()->back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalPrice = $cart->totalPrice;
        return view('site.checkout', ['totalPrice'=>$totalPrice]);
    }

    public function checkout(Request $request)
    {
        dd($request);
    }

}
