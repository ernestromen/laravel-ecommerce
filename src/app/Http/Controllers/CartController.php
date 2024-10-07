<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    public function showCart($id)
    {
        $cart = Cart::where('user_id', '=', $id)->first();
        $cartProducts = $cart->products()->get();
        $totalPriceOfProducts = 0;

        foreach ($cartProducts as $product) {
            $quantityOfProduct = $product->pivot->quantity;
            $productPrice = $product->price;
            $quantityOfProduct > 1 ? $productPrice = $quantityOfProduct * $productPrice : '';
            $totalPriceOfProducts += $productPrice;
        }

        return view("show_cart", ["cartProducts" => $cartProducts, 'totalPriceOfProducts' => $totalPriceOfProducts, 'cardId' => $cart->id]);
    }

    public function showGuestCart()
    {
        $totalPrice = 0;
        if (Session::has('productInCart') && count(Session::get('productInCart')) > 0)
            foreach (Session::get('productInCart') as $product) {
                $totalPrice += (float) $product['price'] * (int) $product['quantity'];
            }

        return view("guest_cart", ['totalPrice' => $totalPrice]);
    }

    public function deleteSessionCartItem(Request $request)
    {

        $i = 0;
        $result = Session::get('productInCart');

        foreach ($result as $product) {

            if ($product['id'] == (int) $request->get('id')) {
                unset($result[$i]);
            }

            ++$i;
            $request->session()->put('productInCart', $result);
        }
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

    public function changeSessionQuantityOfProduct(Request $request)
    {
        $result = Session::get('productInCart');

        foreach ($result as $product) {

            if ($product['id'] == (int) $request->get('id')) {

                if ($request->actionTaken == 'inc') {
                    $result[$product['id'] - 1]['quantity'] = (int) $product['quantity'] + 1;
                    $request->session()->put('productInCart', $result);

                } else {
                    $result[$product['id'] - 1]['quantity'] = (int) $product['quantity'] - 1;
                    $request->session()->put('productInCart', $result);
                }
            }
        }
    }
}
