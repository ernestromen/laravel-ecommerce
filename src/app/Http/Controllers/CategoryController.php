<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view("categories", ["categories" => $categories]);
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
        $categories = Category::all();
        $currentCategory = Category::find($id);

        return view("category", ["id" => $id, 'currentCategory' => $currentCategory, 'categories' => $categories]);
    }

    public function edit(string $id)
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $category = Category::find($id);
        return view("edit_category", ["currentUser" => $currentUser, "category" => $category]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect('/categories');
    }

    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect('/categories');
    }
}
