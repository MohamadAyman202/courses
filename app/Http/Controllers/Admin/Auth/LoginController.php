<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public  function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $attach = $request->only(['email', 'password']);
            if (Auth::guard('admin')->attempt($attach)) {
                return redirect(RouteServiceProvider::admin);
            }
            session()->flash('error', 'The Account Not Found!');
            return redirect()->back();
        }
        return view('backend.Auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return back();
    }
}
