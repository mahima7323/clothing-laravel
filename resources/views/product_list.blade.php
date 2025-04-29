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

        /* Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .toast {
            min-width: 200px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .toast.show {
            opacity: 1;
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

<!-- Modal for confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="controllerMessage"></div>
                <div id="userMessage" style="margin-top: 15px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmAction">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Toasts for success messages -->
<div class="toast-container" id="toast-container"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".add-to-cart, .add-to-wishlist", function() {
            let button = $(this);
            let productId = button.data("id");
            let action = button.hasClass("add-to-cart") ? 'cart' : 'wishlist';

            // Define dynamic messages
            let controllerMessage = action === 'cart' ? 'Product will be added to your cart.' : 'Product will be added to your wishlist.';
            let userMessage = action === 'cart' ? 'Do you want to add this product to your cart?' : 'Do you want to add this product to your wishlist?';

            // Insert messages into the modal
            $('#controllerMessage').html(controllerMessage);
            $('#userMessage').html(userMessage);

            // Show modal
            $('#confirmationModal').modal('show');

            // Handle the confirmation button click
            $('#confirmAction').click(function() {
                $.post(`{{ route('cart.add') }}`, { _token: "{{ csrf_token() }}", id: productId })
                    .done(function(response) {
                        $('#confirmationModal').modal('hide');
                        showToast(response.message); // Show success toast
                    })
                    .fail(function(xhr) {
                        $('#confirmationModal').modal('hide');
                        showToast('Error: ' + xhr.responseJSON.message); // Show error toast
                    });
            });
        });
    });

    // Show success toast
    function showToast(message) {
        let toast = $('<div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">')
            .html(`<div class="toast-body">${message}</div>`);
        $('#toast-container').append(toast);
        setTimeout(() => toast.fadeOut(() => toast.remove()), 3000);
    }
</script>
</body>
</html>
@include('layouts.footer')
