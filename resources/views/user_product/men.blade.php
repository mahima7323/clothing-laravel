@include('layouts.header')

@section('content')
    <h2>Men Collection</h2>
    @if($products->isEmpty())
    <p>No products available in this category.</p>
@else
    @foreach($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Price: ₹{{ number_format($product->price, 2) }}</p>
            
            {{-- Image Display --}}
            @if(!empty($product->image))
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="150">
            @else
                <p>No image available</p>
            @endif
        </div>
    @endforeach
@endif

@endsection
