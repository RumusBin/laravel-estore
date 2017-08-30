<?php
/**
 * Created by PhpStorm.
 * User: Rumus
 * Date: 29.08.2017
 * Time: 11:20
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AdminForgotPasswordController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Admin Password Reset Controller
   |--------------------------------------------------------------------------
   |
   | This controller is responsible for handling password reset emails and
   | includes a trait which assists in sending these notifications from
   | your application to your users. Feel free to explore this trait.
   |
   */

    use SendsPasswordResetEmails;

    protected $redirectTo = 'admin.dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Display the form to request a admin password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email-admin');
    }
}