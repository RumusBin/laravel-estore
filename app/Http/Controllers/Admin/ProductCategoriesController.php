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
        //get list all locales from config file
        $langs = \Config::get('translatable.locales');
        //define field who was translated
        $trans_fields = ['name', 'description', 'meta_title', 'meta_description'];
        //define variable data
        $data = [];
        foreach($trans_fields as $field_name)
        {
            foreach($langs as $lang)
            {
                $data['trans_fields'][$field_name][$lang] = '';
            }
        }
        return view('admin.categories.categories_create', $data);
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
            'translations.*.name' => 'required|max:255'
        ]);
        //create category image path if isset or attach default no-image
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time() . '_' .$request->image->getClientOriginalName().'.png';
            $image->move('images/categories', $imageName);
            $imagePath = '/images/categories/'.$imageName;
        }else {
            $imagePath = '/images/categories/no_image.png';
        }
        //save new category with image path and translations fields
        $category = Category::create();
        $category->fill(['image'=>$imagePath]);
        $category->fill($request->translations);
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
        $langs = \Config::get('translatable.locales');
        $trans_fields = ['name', 'description', 'meta_title', 'meta_description'];
        $category = Category::find($id);
        $params['category'] = $category;
        $params['category']->setDefaultLocale('ru');
        foreach($trans_fields as $field_name)
        {
            foreach($langs as $lang)
            {
                $params['trans_fields'][$field_name][$lang] = !empty(!empty($params['category']) && $params['category']->translate($lang)) ? $params['category']->translate($lang)->$field_name : '';
            }
        }
        return view('admin.categories.categories_edit')->with($params);
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
                'translations.*.description' => 'max:500',
            ]);

            $category = Category::findOrFail($id);
            $category->fill($request->translations);
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
