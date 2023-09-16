<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.add');
    }

    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    public function store(ProductRequest $request)
    {
        $validate = $request->validated();
        $validate['user_id'] = Auth::user()->id;
        $validate['file'] = (new ImageService())->UploadImage($request, 'images/', 'file');
        Product::create($validate);
        return redirect()->route('home');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validate = $request->validated();
        if ($request->file) {
            $validate['file'] = (new ImageService())->UploadImage($request, 'images/', 'file');
        }
        $product->update($validate);
        return redirect()->route('home');
    }

    public function delete(Product $product)
    {
        $product->delete();
        foreach ($product->cart as $cart) {
            $cart->delete();
        }
        return redirect()->back();
    }


}
