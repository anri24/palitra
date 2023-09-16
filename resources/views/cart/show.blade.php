@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">quantity</th>
            <th scope="col">price</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        @foreach($carts as $cart)

            <tr>
                <th scope="row"><img style="width: 100px" src="{{ asset('images/'.$cart->product->file) }}"></th>
                <td>{{ $cart->product->name }}</td>
                <td> {{ $cart->quantity }}
                    <form  method="post" action="{{ route('update.quantity',$cart->id) }}">
                        @csrf
                        <input style="width: 70px" type="number" name="quantity">
                        <button type="submit">submit</button>
                    </form>
                </td>
                <td>${{ $cart->quantity * $cart->product->price }}</td>
                <td>
                    <form method="post" action="{{ route('remove.cart',$cart->id) }}">
                        @csrf
                        <button class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
    @if(!$carts->isEmpty())
<div align="center">
    Amount: ${{ $totalPrice }}
</div>
    @endif
@endsection
