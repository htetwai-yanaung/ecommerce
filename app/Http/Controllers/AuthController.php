<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Direct register page
    public function registerPage()
    {
        return view('admin.register');
    }

    //Direct login page
    public function loginPage()
    {
        return view('admin.login');
    }

    //Home page
    public function homePage()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#categoryPage');
        }
        return redirect()->route('user#homePage');
    }
}