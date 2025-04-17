@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .section-title {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .filter-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .product-card {
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .product-card img {
            width: 100%;
            height: 220px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .product-card h5 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }
        .product-card p {
            font-size: 0.95rem;
            color: #555;
        }
        .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #28a745;
            margin: 10px 0;
        }
        .btn-cart, .btn-wishlist {
            width: 48%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h2 class="section-title">Browse Our Products</h2>

    <!-- Filters -->
    <div class="filter-box">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="category-select" class="form-label">Select Category:</label>
                <select id="category-select" class="form-select">
                    <option value="">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6" id="subcategory-container" style="display: none;">
                <label for="subcategory-select" class="form-label">Select Subcategory:</label>
                <select id="subcategory-select" class="form-select">
                    <option value="">Choose Subcategory</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products -->
    @if($products->isEmpty())
        <div class="alert alert-warning text-center">No products available.</div>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                        <a href="{{ url('product/' . $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <h5>{{ $product->name }}</h5>
                        </a>

                    <p>{{ $product->description }}</p>
                    <div class="price">₹{{ number_format($product->price, 2) }}</div>
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
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Category change
        $('#category-select').change(function() {
            let category_id = $(this).val();
            if (category_id) {
                $('#subcategory-container').show();
                $.get(`{{ url('subcategories') }}/${category_id}`, function(subcategories) {
                    $('#subcategory-select').html('<option value="">Choose Subcategory</option>');
                    subcategories.forEach(function(sub) {
                        $('#subcategory-select').append(`<option value="${sub.id}">${sub.name}</option>`);
                    });
                });
            } else {
                $('#subcategory-container').hide();
            }
        });

        // Subcategory filter
        $('#subcategory-select').change(function() {
            let subcategory_id = $(this).val();
            if (subcategory_id) {
                $.get(`{{ url('filter-products') }}`, {subcategory_id}, function(response) {
                    let productGrid = $('.product-grid').empty();
                    if (response.products.length) {
                        response.products.forEach(product => {
                            productGrid.append(`
                                <div class="product-card">
                                    <a href="/product/${product.id}" style="text-decoration: none;">
                                        <img src="${product.image}" alt="${product.name}">
                                        <h5>${product.name}</h5>
                                    </a>
                                    <p>${product.description}</p>
                                    <div class="price">₹${product.price}</div>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-sm btn-primary btn-cart add-to-cart"
                                                data-id="${product.id}" 
                                                data-name="${product.name}" 
                                                data-price="${product.price}" 
                                                data-image="${product.image}">
                                            <i class="fa fa-cart-plus me-1"></i> Cart
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-wishlist add-to-wishlist"
                                                data-id="${product.id}">
                                            <i class="fa fa-heart me-1"></i> Wishlist
                                        </button>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        productGrid.html('<div class="alert alert-warning text-center w-100">No products in this subcategory.</div>');
                    }
                });
            }
        });

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
    });
</script>
</body>
</html>
@include('layouts.footer')
