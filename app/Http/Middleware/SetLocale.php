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
//        $ip = '89.36.222.166';//
//            $country_code = strtolower(trim(file_get_contents("https://ipapi.co/{$ip}/country/")));////
//        if (Session::has('locale')) {
//            $locale = Session::get('locale', Config::get('app.locale'));
//        } else {
//            if($country_code == 'gb' || $country_code == 'us'){
//                $locale = 'en';
//            }else $locale = $country_code;//
//        }
        //get local from user browser header

            if (Session::has('locale')){
                $locale = Session::get('locale');
                if ($request->segment(1) != $locale){
                    // Store segments in array
                    $segments = $request->segments();
//                    dd($segments);
                    $segments[0] = $locale;
                    // Redirect to the correct url
                    return redirect()->to(implode('/', $segments));                }
            } else {
                if (!in_array($request->segment(1), config('translatable.locales')) ) {
                    $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                    // Store segments in array
                    $segments = $request->segments();
                    $segments = array_prepend($segments, $locale);
                    // Redirect to the correct url
                    return redirect()->to(implode('/', $segments));
                }
            }

        return $next($request);
    }
}