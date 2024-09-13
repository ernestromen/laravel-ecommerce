<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view("edit_permission", ["permission" => $permission]);
    }

    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect('/dashboard');
    }

    public function destroy(string $id)
    {
        Permission::destroy($id);
        return redirect('/dashboard');
    }
}
