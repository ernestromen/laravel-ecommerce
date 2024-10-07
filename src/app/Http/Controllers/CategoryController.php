<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        return view("categories", ["categories" => Category::all()]);
    }

    public function createCategory()
    {
        return view("create_category");
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back()->with('success', 'Successfully added category!');
    }

    public function show(string $id)
    {
        $categories = Category::all();
        $currentCategory = Category::find($id);

        return view("category", ["id" => $id, 'currentCategory' => $currentCategory, 'categories' => $categories]);
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view("edit_category", ["category" => $category]);
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
