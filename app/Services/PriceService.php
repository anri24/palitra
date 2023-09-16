<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class PriceService
{
    public function totalPrice()
    {
        $quantityArr = [];

        $carts = Auth::user()->cart()->get();

        foreach ($carts as $cart){
            $productTotal = $cart->quantity * $cart->product->price;
            array_push($quantityArr,$productTotal);
        }

        return array_sum($quantityArr);

    }
}
