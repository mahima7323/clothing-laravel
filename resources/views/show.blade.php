@include('layouts.header')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    body {
        background-color: #f1f3f6;
        font-family: 'Roboto', sans-serif;
    }

    .product-wrapper {
        background-color: #fff;
        margin: 50px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .product-image {
        width: 100%;
        max-height: 300px; /* Reduced height */
        object-fit: contain;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 10px;
        background-color: #fff;
        transition: 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.02);
    }

    .product-info h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
    }

    .price-section {
        margin: 15px 0;
    }

    .price {
        font-size: 1.8rem;
        color: #e53935;
        font-weight: bold;
    }

    .old-price {
        text-decoration: line-through;
        color: #888;
        margin-left: 10px;
        font-size: 1.1rem;
    }

    .badge-offer {
        background-color: #ff9800;
        color: white;
        padding: 5px 10px;
        font-size: 0.85rem;
        border-radius: 5px;
        margin-left: 10px;
    }

    .description {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 25px;
    }

    .btn-action {
        padding: 12px 30px;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        transition: all 0.3s ease;
        margin-right: 15px;
    }

    .btn-cart {
        background-color: #ff6f00;
        color: white;
    }

    .btn-cart:hover {
        background-color: #e65100;
    }

    .btn-wishlist {
        background-color: #e91e63;
        color: white;
    }

    .btn-wishlist:hover {
        background-color: #ad1457;
    }

    .offers {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border: 1px dashed #ccc;
        border-radius: 8px;
    }

    .offers h5 {
        margin-bottom: 15px;
        font-size: 1.1rem;
        color: #2e7d32;
    }

    .offers ul {
        list-style: none;
        padding: 0;
        font-size: 0.95rem;
    }

    .offers li::before {
        content: "🎁";
        margin-right: 10px;
    }

    .back-link {
        display: inline-block;
        margin-top: 40px;
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .product-image {
            max-height: 200px; /* Further reduced for smaller screens */
        }

        .btn-action {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<div class="container product-wrapper">
    <div class="row">
        <!-- Left: Image -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
        </div>

        <!-- Right: Info -->
        <div class="col-md-6 product-info">
            <h2>{{ $product->name }}</h2>

            <div class="price-section">
                <span class="price">₹{{ number_format($product->price, 2) }}</span>
                <span class="old-price">₹{{ number_format($product->price + 300, 2) }}</span>
                <span class="badge-offer">20% OFF</span>
            </div>

            <p class="description">{{ $product->description }}</p>

            <div class="mb-4">
                <button class="btn-action btn-cart add-to-cart"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-image="{{ asset('storage/' . $product->image) }}">
                    <i class="fa fa-shopping-cart me-1"></i> Add to Cart
                </button>

                <button class="btn-action btn-wishlist add-to-wishlist"
                        data-id="{{ $product->id }}">
                    <i class="fa fa-heart me-1"></i> Wishlist
                </button>
            </div>

            <div class="offers">
                <h5>Available Offers</h5>
                <ul>
                    <li>Extra ₹200 discount on first order</li>
                    <li>10% off with Axis Bank Credit Cards</li>
                    <li>Get GST invoice for business purchases</li>
                </ul>
            </div>

            <a href="{{ url('/product_list') }}" class="back-link">
                <i class="fa fa-arrow-left"></i> Back to Products
            </a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Add to Cart
    $(document).on("click", ".add-to-cart", function () {
        $.post("{{ route('cart.add') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data("id"),
            name: $(this).data("name"),
            price: $(this).data("price"),
            image: $(this).data("image")
        }, function (response) {
            alert(response.message);
        }).fail(function (xhr) {
            alert("Error: " + xhr.responseJSON.message);
        });
    });

    // Add to Wishlist
    $(document).on("click", ".add-to-wishlist", function () {
        $.post("{{ route('wishlist.add') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data("id")
        }, function (response) {
            alert(response.message);
        }).fail(function (xhr) {
            alert("Error: " + xhr.responseJSON.message);
        });
    });
</script>

@include('layouts.footer')
