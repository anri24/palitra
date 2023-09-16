<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Services\PriceService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getUserCart(PriceService $service)
    {
        $totalPrice = $service->totalPrice();
        $carts = Auth::user()->cart;

        return view('cart.show', compact(['carts', 'totalPrice']));
    }

    public function addProductInCart(Product $product)
    {
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ]);

        return redirect()->route('home');
    }

    public function removeProductFromCart(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
    }

    public function setCartProductQuantity(CartRequest $request, Cart $cart)
    {
        if ($request->quantity <= 0){
            $cart->delete();
        }
        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->back();
    }
}
