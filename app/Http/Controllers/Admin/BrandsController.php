<?php

namespace App\Http\Controllers\Admin;


use App\Models\Translations\BrandTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use File;
//use Illuminate\Support\Facades\Mail;
//use App\Mail\BrandCreate;

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

        return view('admin.brands.brands_create', $data);
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
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = md5($request->image->getClientOriginalName()).'.png';
            $image->move('images/brands', $imageName);
            $imagePath = '/images/brands/'.$imageName;
        }else {
            $imagePath = '/images/brands/no_image.png';
        }

        $brand = Brand::create();
        $brand->fill(['image'=>$imagePath]);
        $brand->fill($request->translations);
        $brand->save();
//        Mail::to('bestbrandmarket@gmail.com')->send(new BrandCreate($brand));

        return redirect(route('brands.index'))->with('success', "The brand has successfully been created.");
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
            $langs = \Config::get('translatable.locales');
            $trans_fields = ['name', 'description', 'meta_title', 'meta_description'];
            $brand = Brand::find($id);
            $params['brand'] = $brand;
            $params['brand']->setDefaultLocale('ru');
            foreach($trans_fields as $field_name)
            {
                foreach($langs as $lang)
                {
                    $params['trans_fields'][$field_name][$lang] = !empty(!empty($params['brand']) && $params['brand']->translate($lang)) ? $params['brand']->translate($lang)->$field_name : '';
                }
            }
            return view('admin.brands.brands_edit')->with($params);
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
            $brand = Brand::findOrFail($id);
            $brand->fill($request->translations);
            $brand->save();
            return redirect()->route('brands.index')->with('success', "The brand <strong>$brand->name</strong> has successfully been updated.");
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

    public function imageReload(Request $request)
    {
//        dd($request);
        $brandId = $request->input('itmId');

        $brand = Brand::find($brandId);

        $oldFile = $brand->image;

        File::delete(public_path().$oldFile);
        $newImage = $request->file('img_new');
        if($newImage){
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move('images/brands', $imageName);
            $imagePath = '/images/brands/'.$imageName;
            $brand->image = $imagePath;
            $brand->save();
        }

        return $brandId;

    }
}
