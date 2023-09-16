@extends('layouts.app')

@section('content')
    <img style="width: 200px" src="{{ asset("images/$product->file") }}"><br>
    name: {{ $product->name }}<br>
    price: {{ $product->price }}<br><br>
    @if(\Illuminate\Support\Facades\Auth::user()->id == $product->user_id)
    <a href="{{ route('edit.product',$product->slug) }}">edit</a><br><br>
        <form method="post" action="{{ route('delete.product',$product->id) }}">
            @csrf
            <button type="submit">Delete</button>
        </form>
    @endif
@endsection
