<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public  function get_login()
    {
        return view('backend.Auth.login');

    }

    public  function login(Request $request)
    {
        $attach = $request->only(['email', 'password']);
        if (Auth::guard('teacher')->attempt($attach)) {
            return redirect(RouteServiceProvider::TEACHER);
        }
        session()->flash('error', 'The Account Not Found!');
        return redirect()->back();
    }
}
