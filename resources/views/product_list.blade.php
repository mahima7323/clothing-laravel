@include('layouts.header')
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        .category-list, .subcategory-list {
            margin-bottom: 20px;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .product-card {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 280px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
        }
        .btn-cart, .btn-wishlist {
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-cart {
            background-color: #007bff;
            color: white;
        }
        .btn-cart:hover {
            background-color: #0056b3;
        }
        .btn-wishlist {
            background-color: #dc3545;
            color: white;
        }
        .btn-wishlist:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Available Products</h2>
        
        <!-- Category Selection -->
        <div class="category-list">
            <h4>Select Category:</h4>
            <select id="category-select" class="form-select">
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Selection -->
        <div class="subcategory-list" id="subcategory-container" style="display: none;">
            <h4>Select Subcategory:</h4>
            <select id="subcategory-select" class="form-select">
                <option value="">Select a Subcategory</option>
            </select>
        </div>

        <!-- Product Grid -->
        @if ($products->isEmpty())
            <p>No products available.</p>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @endif
                        <h3>{{ $product->name }}</h3>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p>₹{{ number_format($product->price, 2) }}</p>
                        <button class="btn btn-cart add-to-cart" 
                                data-id="{{ $product->id }}" 
                                data-name="{{ $product->name }}" 
                                data-price="{{ $product->price }}" 
                                data-image="{{ asset('storage/' . $product->image) }}">
                            <i class="fa-solid fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-wishlist add-to-wishlist" 
                                data-id="{{ $product->id }}" 
                                data-name="{{ $product->name }}" 
                                data-price="{{ $product->price }}" 
                                data-image="{{ asset('storage/' . $product->image) }}">
                            <i class="fa-solid fa-heart"></i> Add to Wishlist
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // When a category is selected
            $('#category-select').change(function() {
                var category_id = $(this).val();

                if (category_id) {
                    $('#subcategory-container').show();
                    $.ajax({
                        url: "{{ url('subcategories') }}/" + category_id,
                        method: "GET",
                        success: function(response) {
                            $('#subcategory-select').empty();
                            $('#subcategory-select').append('<option value="">Select a Subcategory</option>');
                            response.forEach(function(subcategory) {
                                $('#subcategory-select').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory-container').hide();
                }
            });

            // When a subcategory is selected
            $('#subcategory-select').change(function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('filter-products') }}", // Filter products based on subcategory
                        method: "GET",
                        data: {
                            subcategory_id: subcategory_id
                        },
                        success: function(response) {
                            // Update the product grid with filtered products
                            var productGrid = $('.product-grid');
                            productGrid.empty();

                            if (response.products.length) {
                                response.products.forEach(function(product) {
                                    productGrid.append(`
                                        <div class="product-card">
                                            <img src="${product.image}" alt="${product.name}">
                                            <h3>${product.name}</h3>
                                            <p><strong>Description:</strong> ${product.description}</p>
                                            <p>₹${product.price}</p>
                                            <button class="btn btn-cart add-to-cart" 
                                                    data-id="${product.id}" 
                                                    data-name="${product.name}" 
                                                    data-price="${product.price}" 
                                                    data-image="${product.image}">
                                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                            </button>
                                            <button class="btn btn-wishlist add-to-wishlist" 
                                                    data-id="${product.id}" 
                                                    data-name="${product.name}" 
                                                    data-price="${product.price}" 
                                                    data-image="${product.image}">
                                                <i class="fa-solid fa-heart"></i> Add to Wishlist
                                            </button>
                                        </div>
                                    `);
                                });
                            } else {
                                productGrid.append('<p>No products available in this subcategory.</p>');
                            }
                        }
                    });
                }
            });

            // Add to Cart
            $(document).on("click", ".add-to-cart", function() {
                var product_id = $(this).data("id");
                var name = $(this).data("name");
                var price = $(this).data("price");
                var image = $(this).data("image");

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        name: name,
                        price: price,
                        image: image
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });

            // Add to Wishlist
            $(document).on("click", ".add-to-wishlist", function() {
                var product_id = $(this).data("id");

                $.ajax({
                    url: "{{ route('wishlist.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });
       
        });
    </script>
</body>
</html>
@include('layouts.footer')
