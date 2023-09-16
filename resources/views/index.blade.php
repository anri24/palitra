@extends('layouts.app')

@section('content')

    <div class="row">
        @forelse($products as $product)
            <div class="card" style="width: 18rem; margin-left: 20px">
                <img src="{{ asset("images/$product->file") }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">${{ $product->price }}</p>
                    <a href="{{ route('show.product',$product->slug) }}" class="btn btn-primary">see product</a><br>

                    @if(Auth::user() && $userCart->contains('product_id',$product->id))
                    <form method="post" action="{{ route('remove.cart',$userCart->where('product_id',$product->id)->first()->id) }}">
                        @csrf
                        <button class="btn btn-danger">Remove From Cart</button>
                    </form>
                    @else
                        <form method="post" action="{{ route('add.cart',$product->slug) }}">
                            @csrf
                            <button class="btn btn-success">add in cart</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div align="center">
                no products
            </div>
        @endforelse
    </div>
@endsection
