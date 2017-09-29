<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use File;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = new Category;

        return view('admin.categories.categories_list', ['categories'=>$categories->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.categories_create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $this->validate($request, [
            'name' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time() . '_' .$request->image->getClientOriginalName().'.png';
            $image->move('images/categories', $imageName);
            $imagePath = '/images/categories/'.$imageName;
        }else {
            $imagePath = '/images/categories/no_image.png';
        }

        $category->name = $request->name;
        $category->image = $imagePath;
        $category->description = $request->description;
        $category->save();
        return redirect(route('product-categories.index'))->with('success', "The category <strong>$category->name</strong> has successfully been created.");
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
            $category = Category::findOrFail($id);

            $params = [
                'title' => 'Delete category',
                'category' => $category,
            ];

            return view('admin.categories.categories_delete')->with($params);
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
            $category = Category::findOrFail($id);
            $params = [
                'title' => 'Edit Category',
                'category' => $category,
            ];
            return view('admin.categories.categories_edit')->with($params);
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
                'name' => 'required|unique:categories,name,'.$id,
                'description' => 'required',
            ]);

            $category = Category::findOrFail($id);
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->save();
            return redirect()->route('product-categories.index')->with('success', "The product category <strong>Category</strong> has successfully been updated.");
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
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('product-categories.index');
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function imageReload(Request $request)
    {

        $categoryId = $request->input('itmId');

        $category = Category::find($categoryId);

        $oldFile = $category->image;

        File::delete(public_path().$oldFile);

        $newImage = $request->file('img_new');

        if($newImage){
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move('images/categories', $imageName);
            $imagePath = '/images/categories/'.$imageName;
            $category->image = $imagePath;
            $category->save();
        }

        return $categoryId;

    }
}
