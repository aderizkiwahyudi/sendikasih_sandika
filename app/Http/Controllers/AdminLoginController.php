<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('admin.login');
    }
    public function prosess(Request $request)
    {
        $user = User::where('role_id', 1)->where('username', $request->username)->orWhere('email', $request->username)->first();
        if(!$user){
            Session::flash('failed', 'Username atau email tidak ditemukan');
            return back();
        }

        if(password_verify($request->password, $user->password)){
            Auth::guard('admin')->login($user);
            return redirect(route('admin.dashboard'));
        }

        Session::flash('failed', 'Password yang anda masukan salah');
        return back();
    }
}
