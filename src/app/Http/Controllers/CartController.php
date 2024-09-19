<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;

class CartController extends Controller
{
    public function showCart($id)
    {
        $user = User::find($id);
        $cart = Cart::where('user_id', '=', $id)->first();
        $cartProducts = $cart->products()->get();

        return view("show_cart", ["cartProducts" => $cartProducts]);
    }

    public function deleteCartItem($id)
    {
        $cart = Cart::where('user_id', '=', Auth::id())->first();
        $cart->products()->detach($id);

        return redirect()->back();
    }

    public function changeQuantityOfProduct($productId, Request $request)
    {
        $cart = Cart::where('user_id', '=', Auth::id())->first();

        if (!is_null($request->focusValue)) {
            foreach ($cart->products as $cartItem) {

                if ($cartItem->id == (int) $productId) {
                    $currentQuantity = $cartItem->pivot->quantity;
                    // $newQuantity = ++$currentQuantity;
                    $cart->products()->updateExistingPivot($cartItem, ['quantity' => (int) $request->focusValue]);
                }
            }
            return 'check DB';
        }
        if ($request->actionTaken == 'inc') {

            foreach ($cart->products as $cartItem) {

                if ($cartItem->id == (int) $productId) {
                    $currentQuantity = $cartItem->pivot->quantity;
                    $newQuantity = ++$currentQuantity;
                    $cart->products()->updateExistingPivot($cartItem, ['quantity' => $newQuantity]);
                }
            }
        } else {
            foreach ($cart->products as $cartItem) {

                if ($cartItem->id == (int) $productId) {
                    $currentQuantity = $cartItem->pivot->quantity;
                    $newQuantity = --$currentQuantity;
                    $cart->products()->updateExistingPivot($cartItem, ['quantity' => $newQuantity]);
                }
            }

        }

        return 'check database!';
    }
}
