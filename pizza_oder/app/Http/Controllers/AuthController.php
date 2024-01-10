<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login page
    public function loginpage() {
        return view('login');
    }
    public function registerpage() {
        return view('register');
    }
    public function dashboard() {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('listpage');
        }
        return redirect()->route('homepage');
    }
}
