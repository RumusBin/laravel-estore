<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App;
use Config;

class SetLocale
{
    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // get locale from user ip
//        $ip = '89.36.222.166';
//
//            $country_code = strtolower(trim(file_get_contents("https://ipapi.co/{$ip}/country/")));
//
//
//        if (Session::has('locale')) {
//            $locale = Session::get('locale', Config::get('app.locale'));
//        } else {
//            if($country_code == 'gb' || $country_code == 'us'){
//                $locale = 'en';
//            }else $locale = $country_code;
//
//        }

        //get local from user browser header


        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
            app()->setLocale($locale);
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if(!array_key_exists($locale, config('translatable.locales')) ) {
                $locale = config('app.fallback_locale');
                app()->setLocale($locale);
            }

        }
//        dd($locale);
//        if($locale == 'ru'){
//            // Store segments in array
//            $segments = $request->segments();
//
//            // Set the default language code as the first segment
//            $segments = array_slice($segments, 1);
//
//            // Redirect to the correct url
//            return redirect()->to(implode('/', $segments));
//        }


        if ($request->segment(1) != $locale ) {

            // Store segments in array
            $segments = $request->segments();

            // Set the default language code as the first segment
            $segments = array_replace($segments, [0=>$locale]);

            // Redirect to the correct url
            return redirect()->to(implode('/', $segments));
        }


        return $next($request);
    }
}