<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\cartCreated;

class UserController extends Controller
{
    public function register()
    {
        return view("register");
    }

    public function login()
    {
        return view("login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
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

    public function addUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'bail|required|unique:users|max:255',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->setRememberToken(Str::random(10));
        $user->save();
        event(new cartCreated($user));
        //attach the role_id that is needed 2 or 1 for admin
        $user->roles()->attach('2');
        Auth::login($user);
        return redirect('/')->with('user', $user);
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view("edit_user", ["user" => $user]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/dashboard');
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view("show_user", ["user" => $user]);
    }

    public function saveImage(Request $request)
    {
        $request->validate([
            'imageUrl' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('imageUrl');
        $originalName = $file->getClientOriginalName();
        $product = User::find($id);
        $product->image = $originalName;
        $product->save();
        $request->imageUrl->move(public_path('images'), $originalName);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
