<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = new Brand;

        return view('admin.brands.brands_list', ['brands'=>$brands->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.brands_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $this->validate($request, [
            'name' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = md5($request->image->getClientOriginalName()).'.jpg';
            $image->move('images/brands', $imageName);
        }else {
            $imageName = 'no_image.png';
        }

        $brand->name = $request->name;
        $brand->image = $imageName;
        $brand->description = $request->description;
        $brand->save();

        return redirect(route('brands.index'))->with('success', "The brand <strong>$brand->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $brand = Brand::findOrFail($id);

            $params = [
                'title' => 'Delete Brand',
                'brand' => $brand,
            ];

            return view('admin.brands.brands_delete')->with($params);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $brand = Brand::findOrFail($id);
            $params = [
                'title' => 'Edit Brand',
                'brand' => $brand,
            ];
            return view('admin.brands.brands_edit')->with($params);
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
        //
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
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return redirect()->route('brands.index');
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function brandRip(){
        $delBrands = Brand::onlyTrashed()->get();

        return view('admin.brands.brands_rip', ['delBrands'=>$delBrands]);
    }
}
