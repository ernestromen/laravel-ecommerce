<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function index()
    {
        $user = Auth::user() ? Auth::user()->name : '';

        return view("index", ["user" => $user]);
    }

    public function register()
    {
        return view("register", ["user" => Auth::user()->name]);
    }

    public function login()
    {

        $user = Auth::user();

        return view("login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }
}
