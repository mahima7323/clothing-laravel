@include('layouts.header')

<style>
    .product-details {
        padding: 50px 0;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb {
        background: none;
        padding-left: 0;
        margin-bottom: 30px;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }

    .product-image {
        width: 100%;
        height: auto;
        max-width: 100%;
        max-height: 400px; /* Adjust as necessary */
        object-fit: contain; /* Ensures the image fits inside without distortion */
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .product-info h2 {
        font-size: 2.2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        transition: color 0.3s ease;
    }

    .product-info h2:hover {
        color: #007bff;
    }

    .product-info .price {
        font-size: 1.8rem;
        color: #b12704;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .old-price {
        text-decoration: line-through;
        color: #888;
        margin-left: 15px;
        font-size: 1.2rem;
    }

    .offers {
        margin-top: 25px;
        background: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .offers ul {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }

    .offers li {
        margin-bottom: 12px;
        font-size: 1.1rem;
    }

    .offers li::before {
        content: "✔️ ";
        color: #28a745;
    }

    .btn-back, .btn-home, .btn-products {
        margin-top: 20px;
        display: inline-block;
        font-size: 1.3rem;
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
        transition: background-color 0.3s ease, transform 0.3s ease;
        text-align: center;
    }

    .btn-back:hover, .btn-home:hover, .btn-products:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .footer-buttons {
        text-align: center;
        margin-top: 40px;
    }

    .footer-buttons a {
        margin: 0 15px;
    }

    @media (max-width: 768px) {
        .product-info {
            text-align: center;
        }

        .product-image {
            max-height: 300px;
        }

        .btn-back, .btn-home, .btn-products {
            font-size: 1rem;
            padding: 8px 20px;
        }
    }
</style>

<div class="container product-details">
    <!-- Breadcrumbs -->

    <div class="row align-items-center">
        <!-- Left side: Image -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
        </div>

        <!-- Right side: Info -->
        <div class="col-md-6 product-info">
            <h2>{{ $product->name }}</h2>
            <p class="price">₹{{ number_format($product->price, 2) }}
                <span class="old-price">₹{{ number_format($product->price + 300, 2) }}</span>
            </p>
            <p>{{ $product->description }}</p>
            <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-primary btn-cart add-to-cart"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-image="{{ asset('storage/' . $product->image) }}">
                    <i class="fa fa-cart-plus me-1"></i> Cart
                </button>
                <button class="btn btn-sm btn-danger btn-wishlist add-to-wishlist"
                        data-id="{{ $product->id }}">
                    <i class="fa fa-heart me-1"></i> Wishlist
                </button>
            </div>

            <div class="offers">
                <strong>Offers:</strong>
                <ul>
                    <li>💰 Cashback: Upto ₹20 via Pay balance</li>
                    <li>🏦 Bank Offer: Upto ₹3,000 off on credit cards</li>
                    <li>📄 GST Invoice for business purchases</li>
                </ul>
            </div>

            <!-- Back Button -->
            <a href="{{ url('/product_list') }}" class="btn btn-outline-secondary btn-back">
                ⬅ Back to Products
            </a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Add to Cart
    $(document).on("click", ".add-to-cart", function() {
        $.post("{{ route('cart.add') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data("id"),
            name: $(this).data("name"),
            price: $(this).data("price"),
            image: $(this).data("image")
        }, function(response) {
            alert(response.message);
        }).fail(function(xhr) {
            alert("Error: " + xhr.responseJSON.message);
        });
    });

    // Add to Wishlist
    $(document).on("click", ".add-to-wishlist", function() {
        $.post("{{ route('wishlist.add') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data("id")
        }, function(response) {
            alert(response.message);
        }).fail(function(xhr) {
            alert("Error: " + xhr.responseJSON.message);
        });
    });
</script>

<!-- Footer with Home and Products Buttons -->

@include('layouts.footer')
