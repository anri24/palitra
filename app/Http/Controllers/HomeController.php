<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::query()->orderBy('id', 'DESC')->get();
        $userCart = '';
        if (Auth::check()) {
            $userCart = Auth::user()->cart;
        }

        return view('index', compact(['products', 'userCart']));
    }
}
