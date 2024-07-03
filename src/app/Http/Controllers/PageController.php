<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class PageController extends Controller
{


    public function index()
    {
        $user = Auth::user() ? Auth::user()->name : '';
        return view("index", ["user" => $user,]);
    }

    public function register()
    {
        $user = Auth::user() ? Auth::user()->name : "";
        return view("register", ["user" => $user]);
    }

    public function login()
    {
        // dd('hello');
        $user = Auth::user() ? Auth::user()->name : "";
        // dd($user);
        return view("login", ["user" => $user]);
    }


    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            // Now $user holds the authenticated user instance
            return redirect()->intended('/dashboard'); // Redirect to dashboard or any other desired location
        }

        // Authentication failed...
        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }


    public function dashboard()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $users = User::get()->all();
        $roles = Role::get()->all();
        $permissions = Permission::get()->all();

        return view("dashboard", ["currentUser" => $currentUser, 'users' => $users, 'roles' => $roles, 'permissions' => $permissions]);
    }
}
