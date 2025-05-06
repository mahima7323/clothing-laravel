<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            width: 85%;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: #2c3e50;
            font-size: 30px;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            position: relative;
            padding-left: 35px;
        }

        h2 i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #3498db;
        }

        .empty-cart {
            color: #888;
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
            color: #555;
        }

        th {
            background-color: #3498db;
            color: white;
            text-transform: uppercase;
        }

        td img {
            width: 60px;
            border-radius: 5px;
        }

        .btn-danger, .btn-success {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
            padding: 12px 25px;
            font-size: 18px;
        }

        .btn-success:hover {
            background-color: #219150;
            transform: scale(1.05);
        }

        .quantity {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quantity button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .quantity button:hover {
            background-color: #2980b9;
        }

        .quantity input {
            width: 45px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
            margin: 0 10px;
            border-radius: 5px;
        }

        .grand-total {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 30px;
        }

        .flash-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
            display: none;
            text-align: center;
        }

        .flash-success {
            background-color: #d4edda;
            color: #155724;
        }

        .flash-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .btn-success, .btn-danger {
                font-size: 14px;
                padding: 6px 12px;
            }

            .quantity button {
                font-size: 16px;
            }

            .quantity input {
                width: 30px;
            }
        }
    </style>
</head>
<body>

@include('layouts.header')

<div class="container">
    <h2><i class="fa-solid fa-cart-shopping"></i> Shopping Cart</h2>

    {{-- Flash Messages --}}
    <div id="flashMessage" class="flash-message"></div>

    @if(empty($cart))
        <p class="empty-cart">Your cart is empty. <i class="fa-solid fa-box-open"></i></p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr id="cart-item-{{ $item['id'] }}">
                        <td><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>₹{{ number_format($item['price'], 2) }}</td>
                        <td>
                            <div class="quantity">
                                <button class="decrease-qty" data-id="{{ $item['id'] }}">-</button>
                                <input type="text" id="qty-{{ $item['id'] }}" value="{{ $item['quantity'] }}" readonly>
                                <button class="increase-qty" data-id="{{ $item['id'] }}">+</button>
                            </div>
                        </td>
                        <td id="total-{{ $item['id'] }}" data-price="{{ $item['price'] }}">
                            ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>
                        <td>
                            <button class="btn-danger remove-item" data-id="{{ $item['id'] }}"><i class="fa-solid fa-trash"></i> Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="grand-total">Grand Total: <span id="grand-total">₹{{ number_format($grandTotal, 2) }}</span></p>

        <form id="order-form">
            @csrf
            <button type="submit" class="btn-success">Place Order</button>
        </form>
    @endif
</div>

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function showFlashMessage(message, type) {
            var flashMessage = $("#flashMessage");
            flashMessage.text(message);
            if (type === 'success') {
                flashMessage.removeClass('flash-error').addClass('flash-success');
            } else {
                flashMessage.removeClass('flash-success').addClass('flash-error');
            }
            flashMessage.fadeIn().delay(3000).fadeOut();
        }

        function updateGrandTotal() {
            let total = 0;
            $("td[id^='total-']").each(function () {
                total += parseFloat($(this).text().replace("₹", ""));
            });
            $("#grand-total").text("₹" + total.toFixed(2));
        }

        $('.increase-qty, .decrease-qty').click(function () {
            let id = $(this).data("id");
            let qtyInput = $("#qty-" + id);
            let currentQty = parseInt(qtyInput.val());
            let price = parseFloat($("#total-" + id).data("price"));
            let change = $(this).hasClass("increase-qty") ? 1 : -1;
            let newQty = currentQty + change;

            if (newQty < 1) return;

            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: id,
                    quantity: newQty
                },
                success: function (response) {
                    qtyInput.val(newQty);
                    let newTotal = (price * newQty).toFixed(2);
                    $("#total-" + id).text("₹" + newTotal);
                    updateGrandTotal();
                    showFlashMessage("Cart updated successfully!", "success");
                },
                error: function () {
                    showFlashMessage("Failed to update quantity. Please try again.", "error");
                }
            });
        });

        $('.remove-item').click(function () {
            var itemId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to remove this item from the cart.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#999'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cart.remove') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: itemId
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#cart-item-' + itemId).fadeOut(300, function () {
                                    $(this).remove();
                                    updateGrandTotal();
                                    showFlashMessage("Item removed from cart.", "success");
                                });
                            } else {
                                showFlashMessage('Unable to remove item.', "error");
                            }
                        },
                        error: function () {
                            showFlashMessage('Something went wrong. Please try again.', "error");
                        }
                    });
                }
            });
        });

        $("#order-form").submit(function (e) {
            e.preventDefault();
            window.location.href = "{{ url('address/create') }}";
        });
    });
</script>

</body>
</html>
