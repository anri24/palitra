@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('update.product',$product->slug) }}"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Image</label>
            <input type="file" name="file" class="form-control" id="file">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
