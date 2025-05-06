@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .section-title {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #2c3e50;
            font-size: 2rem;
            text-transform: uppercase;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, #3498db, #2ecc71);
        }

        .filter-box {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .filter-box .row {
            display: flex;
            gap: 20px; /* Add spacing between dropdowns */
            align-items: center; /* Align dropdowns vertically */
            flex-wrap: wrap; /* Ensure responsiveness */
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 2px solid #f1f1f1;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .product-card h5 {
            font-size: 1.4rem;
            margin: 15px 0 10px;
            color: #2c3e50;
            font-weight: bold;
        }

        .product-card p {
            font-size: 1rem;
            color: #7f8c8d;
            margin-bottom: 15px;
            min-height: 40px; /* Ensure consistent height for descriptions */
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 15px;
        }

        .btn-cart, .btn-wishlist {
            width: 48%;
            margin-top: 10px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-cart {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: #fff;
        }

        .btn-wishlist {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            color: #fff;
        }

        .btn-cart:hover, .btn-wishlist:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Ensure buttons are vertically aligned */
            flex-wrap: wrap; /* Allow wrapping if needed */
            gap: 10px; /* Add spacing between buttons */
            min-height: 50px; /* Set a consistent height for the button container */
        }

        .btn-cart, .btn-wishlist {
            flex: 1; /* Ensure buttons take equal width */
            max-width: 48%; /* Prevent buttons from exceeding 48% of the container width */
            margin: 0; /* Remove extra margins */
            padding: 10px 15px; /* Adjust padding for better fit */
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: bold;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-cart {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: #fff;
        }

        .btn-wishlist {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            color: #fff;
        }

        .btn-cart:hover, .btn-wishlist:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .product-card {
            padding: 15px; /* Add padding to ensure content fits well */
        }

        /* Dropdown Styling */
        .form-select {
            background: #f8f9fa;
            border: 2px solid #3498db;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 500;
            color: #2c3e50;
            transition: all 0.3s ease;
            width: 100%; /* Ensure full width in smaller screens */
            max-width: 100%; /* Prevent overflow */
        }

        .form-select:focus {
            outline: none;
            border-color: #2ecc71;
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .filter-box .row {
                flex-direction: column; /* Stack dropdowns vertically on smaller screens */
            }
        }

        .product-card .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #e74c3c;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h2 class="section-title">Browse Our Products</h2>

    <!-- Filters -->
    <div class="filter-box">
        <div class="row">
            <!-- Category Dropdown -->
            <div class="col-md-6">
                <label for="category-select" class="form-label">Select Category:</label>
                <select id="category-select" class="form-select">
                    <option value="">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory Dropdown -->
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
                    @if($product->is_new)
                        <span class="badge">New</span>
                    @endif
                    <a href="{{ url('product/' . $product->id) }}" style="text-decoration: none;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <h5>{{ $product->name }}</h5>
                    </a>
                    <p>{{ $product->description }}</p>
                    <div class="price">₹{{ number_format($product->price, 2) }}</div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-cart add-to-cart"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-image="{{ asset('storage/' . $product->image) }}">
                            <i class="fa fa-cart-plus me-1"></i> Cart
                        </button>
                        <button class="btn btn-sm btn-wishlist add-to-wishlist"
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                        <button class="btn btn-sm btn-cart add-to-cart"
                                                data-id="${product.id}" 
                                                data-name="${product.name}" 
                                                data-price="${product.price}" 
                                                data-image="${product.image}">
                                            <i class="fa fa-cart-plus me-1"></i> Cart
                                        </button>
                                        <button class="btn btn-sm btn-wishlist add-to-wishlist"
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
                // Show SweetAlert2 popup
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message,
                    showConfirmButton: true
                });
            });
        });

        // Add to Wishlist
        $(document).on("click", ".add-to-wishlist", function() {
            $.post("{{ route('wishlist.add') }}", {
                _token: "{{ csrf_token() }}",
                id: $(this).data("id")
            }, function(response) {
                // Show SweetAlert2 popup
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Wishlist',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }).fail(function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message,
                    showConfirmButton: true
                });
            });
        });
    });
</script>
</body>
</html>
@include('layouts.footer')
