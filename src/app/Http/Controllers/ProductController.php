<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
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
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $product = Product::find($id);
        return view("edit_product",["currentUser" => $currentUser,"product"=>$product]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sku = $request->SKU;
        $product->quantity = $request->quantity;
        $product->save();

        return redirect('/products');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
