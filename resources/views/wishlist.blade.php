<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #c1c1c1, #f7f7f7);
            color: #333;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Flash Messages */
        .alert-success, .alert-warning {
            padding: 12px;
            margin: 20px 0;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
        }

        .alert-success {
            background-color: #a3e1d4;
            color: #2e8b84;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Wishlist Empty State */
        .empty-wishlist {
            text-align: center;
            font-size: 20px;
            color: #999;
            margin-top: 40px;
            font-weight: 600;
        }

        /* Card Styling */
        .product-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9f9f9;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .product-card img:hover {
            transform: scale(1.1);
        }

        .product-card .details {
            flex: 1;
            padding: 0 20px;
            text-align: left;
        }

        .product-card .details h3 {
            font-size: 20px;
            color: #333;
            font-weight: 700;
        }

        .product-card .details p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .product-card .price {
            font-size: 20px;
            color: #e74c3c;
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
        }

        .actions button {
            padding: 12px 18px;
            border-radius: 30px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-dark {
            background: #2c3e50;
            color: white;
            border: none;
        }

        .btn-dark:hover {
            background: #34495e;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        /* Button for adding to cart */
        .add-to-cart {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            border: none;
        }

        .add-to-cart:hover {
            background: linear-gradient(135deg, #2980b9, #27ae60);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .product-card {
                flex-direction: column;
                align-items: center;
            }

            .product-card img {
                margin-bottom: 15px;
            }

            .product-card .details {
                text-align: center;
            }
        }
    </style>
</head>
<body>

    @include('layouts.header') {{-- ✅ Move here after <body> --}}

    <div class="container">
        <h2><i class="fa-solid fa-heart"></i> Your Wishlist</h2>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('warning'))
            <div class="alert-warning">{{ session('warning') }}</div>
        @endif

        @if($wishlist->isEmpty())
            <p class="empty-wishlist">Your wishlist is empty. <i class="fa-solid fa-box-open"></i></p>
        @else
            @foreach($wishlist as $item)
                @if($item->product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        <div class="details">
                            <h3>{{ $item->product->name }}</h3>
                            <p>{{ Str::limit($item->product->description, 80, '...') }}</p>
                            <div class="price">₹{{ number_format($item->product->price, 2) }}</div>
                        </div>
                        <div class="actions">
                            <button class="add-to-cart" 
                                    data-id="{{ $item->product->id }}" 
                                    data-name="{{ $item->product->name }}" 
                                    data-price="{{ $item->product->price }}" 
                                    data-image="{{ asset('storage/' . $item->product->image) }}">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>

                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->product->id }}">
                                <button class="btn-danger"><i class="fa-solid fa-trash"></i> Remove</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    @include('layouts.footer') {{-- ✅ Should be inside <body> too --}}

    <script>
        $(document).ready(function() {
            // Add to Cart with Confirmation
            $(document).on("click", ".add-to-cart", function(e) {
                e.preventDefault();
                var button = $(this);
                var product_id = button.data("id");
                var name = button.data("name");
                var price = button.data("price");
                var image = button.data("image");

                Swal.fire({
                    title: 'Move to Cart?',
                    text: "Do you want to move this item to cart?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2c3e50',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, move it!'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                Swal.fire('Added!', response.message, 'success');
                            },
                            error: function(xhr) {
                                Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Remove from Wishlist with Confirmation
            $(document).on("submit", "form", function(e) {
                var form = this;
                if ($(form).find("input[name='id']").length > 0) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This item will be removed from your wishlist!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, remove it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
