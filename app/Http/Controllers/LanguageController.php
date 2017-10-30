<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index(){



//
//        $locale = strtolower($lang);
//
//            if(!session('locale')){
//                return  session(['locale'=> $locale]);
//            }
////
//        if($ip){
//            $json = file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn=' . $ip);
//            $data = json_decode($json);
//           return '<b>' . $ip . '</b> resolves to:' . var_dump($data);
//        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changelocale(Request $request)
    {
//        dd($request['locale']);
        $this->validate($request, ['locale' => 'required|in:ru,ua,en']);
        $locale = $request['locale'];

        Session::put('locale', $locale);

        return redirect()->back();
    }
}
