@extends('layouts.app')

@section('content')
    <h2>Men's Collection</h2>
    <div class="product-list">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>${{ $product->price }}</p>
                <a href="{{ route('product.detail', $product->id) }}">View Details</a>
            </div>
        @endforeach
    </div>
@endsection
