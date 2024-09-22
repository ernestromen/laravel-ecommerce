<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckOutController extends Controller
{
    public function checkout($id)
    {
        
        $cart = Cart::where('user_id', '=', $id)->first();
        $cartProducts = $cart->products()->get();
        $totalPriceOfProducts = 0;

        foreach ($cartProducts as $product) {
            $totalPriceOfProducts += $product->price;
        };
        return view("checkout",['totalPriceOfProducts'=>$totalPriceOfProducts]);
    }
}
