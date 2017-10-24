<?php

namespace App\Http\Site\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile()
    {
        $orders = Auth::user()->orders;

        $orders->transform(function($order, $key){
            $order->cart = userialize($order->cart);
        });

        return view('profile', ['orders'=>$orders]);
    }
}