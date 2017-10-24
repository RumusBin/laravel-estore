<?php
/**
 * Created by PhpStorm.
 * User: Rumus
 * Date: 20.10.2017
 * Time: 14:02
 */

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Mail\NewOrder;
use App\Models\User;


class OrderController extends Controller
{
    public function newOrder(Request $request)
    {
//        dd($request->warhouse_checked);
        if(!Session::has('cart'))
        {
            return view('site.shopping-cart');
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        $order = new Order();
        $order->cart = serialize($cart);
        if($request->user_id){
            $order->user_id = $request->user_id;
        }else $order->user_id = 1;
        $order->name = $request->name;
        if($request->surname){
            $order->surname = $request->surname;
        }
        if($request->message){
            $order->message = $request->message;
        }
        $order->phone = $request->phone;
        $order->city = $request->town_choose;
        $order->warhouse = $request->warhouse_checked;

        if(Auth::user()){
            Auth::user()->orders()->save($order);
        }else{
            User::find(1)->orders()->save($order);
        }


        Mail::to('komlikov.r@gmail.com')->send(new NewOrder($order));
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Ваш заказ успешно сохранен!');
    }
}