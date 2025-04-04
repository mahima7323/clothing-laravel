@include('layouts.header')

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 26px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td img {
            width: 50px;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s;
        }

        .btn-success:hover {
            background-color: #219150;
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
            padding: 5px 10px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .quantity button:hover {
            background-color: #2980b9;
        }

        .quantity input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
            margin: 0 5px;
        }

        .grand-total {
            font-size: 20px;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fa-solid fa-cart-shopping"></i> Shopping Cart</h2>

        @if(empty($cart))
            <p class="empty-cart">Your cart is empty. <i class="fa-solid fa-box-open"></i></p>
        @else
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                @foreach($cart as $id => $item)
                    <tr id="cart-item-{{ $id }}">
                        <td><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>₹{{ number_format($item['price'], 2) }}</td>
                        <td>
                            <div class="quantity">
                                <button class="decrease-qty" data-id="{{ $id }}">-</button>
                                <input type="text" id="qty-{{ $id }}" value="{{ $item['quantity'] }}" readonly>
                                <button class="increase-qty" data-id="{{ $id }}">+</button>
                            </div>
                        </td>
                        <td id="total-{{ $id }}" data-price="{{ $item['price'] }}">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <button class="btn-danger remove-from-cart" data-id="{{ $id }}">
                                <i class="fa-solid fa-trash"></i> Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
            <p class="grand-total">Grand Total: <span id="grand-total">₹{{ number_format($grandTotal, 2) }}</span></p>
            <form id="order-form">
                @csrf
                <button type="submit" class="btn-success">Place Order</button>
            </form>
        @endif
    </div>

    <script>
        $(document).ready(function () {
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

                qtyInput.val(newQty);
                let newTotal = (price * newQty).toFixed(2);
                $("#total-" + id).text("₹" + newTotal);

                updateGrandTotal();
            });

            $(document).on("click", ".remove-from-cart", function () {
                let id = $(this).data("id");
                $("#cart-item-" + id).fadeOut(300, function () {
                    $(this).remove();
                    updateGrandTotal();
                });
            });

            $("#order-form").submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('order.place') }}",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Success!', response.message, 'success')
                                .then(() => {
                                    window.location.href = response.redirect;
                                });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                    }
                });
            });
        });
    </script>
    
    @include('layouts.footer')
</body>
</html>
