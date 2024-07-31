<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{

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
        //attach the role_id that is needed 2 or 1 for admin
        $user->roles()->attach('2');
        Auth::login($user);
        return redirect('/')->with('user', $user);
    }

    public function edit(string $id){
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $user = User::find($id);
        return view("edit_user", ["currentUser" => $currentUser, "user" => $user]);
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

}
