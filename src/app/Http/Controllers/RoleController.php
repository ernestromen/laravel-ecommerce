<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RoleController extends Controller
{

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function edit(string $id)
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $role = Role::find($id);
        return view("edit_role", ["currentUser" => $currentUser, "role" => $role]);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        return redirect('/dashboard');
    }

    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect('/dashboard');
    }
}
