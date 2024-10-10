<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;

class ProductController extends Controller
{

    public function product($id)
    {
        $currentProduct = Product::find($id);
        $currentProductCategory = $currentProduct->category;

        return view("product", ["id" => $id, 'currentProduct' => $currentProduct, 'currentProductCategory' => $currentProductCategory]);
    }

    public function products()
    {
        return view("products", ["products" => Product::all()]);
    }

    public function storeImage(Request $request, string $id)
    {

        $request->validate([
            'imageUrl' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('imageUrl');
        $originalName = $file->getClientOriginalName();
        $product = Product::find($id);
        $product->image = $originalName;
        $product->save();
        $request->imageUrl->move(public_path('images'), $originalName);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("edit_product", ["product" => $product]);
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
        Product::destroy($id);

        return redirect()->back()->with('success', 'Successfully deleted product!');
    }


    public function addProductToCart($productId, Request $request)
    {
        $product = Product::find($productId);
        $cart = Cart::where('user_id', '=', Auth::id())->first();
        $hasProduct = $cart->products()->where('product_id', $productId)->exists();

        if ($hasProduct) {
            foreach ($cart->products as $cartItem) {

                if ($cartItem->id == (int) $productId) {
                    $currentQuantity = $cartItem->pivot->quantity;
                    $newQuantity = (int) $request->quantity == 1 ? ++$currentQuantity : (int) $request->quantity + $currentQuantity;
                    $cart->products()->updateExistingPivot($cartItem, ['quantity' => $newQuantity]);
                }
            }
        } else {
            (int) $request->quantity == 1 ? $cart->products()->attach($product->id, ['quantity' => 1])
                : $cart->products()->attach($product->id, ['quantity' => (int) $request->quantity])
            ;
        }
        return redirect()->back();
    }

    public function addProductToSessionCart($productId, Request $request)
    {
        $product = Product::find($productId);
        $request->session()->push('productInCart', [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->get('quantity')
        ]);

        return redirect()->back();
    }

    public function createProduct()
    {
        $categories = Category::all();

        return view("create_product", ['categories' => $categories]);
    }

    public function storeCreatedProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'SKU' => 'required',
            'quantity' => 'required',
            'category' => 'required'

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;
        $product->save();

        return redirect()->back()->with('success', 'Successfully added product!');
    }
}
