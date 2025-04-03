@include('layouts.header')

<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .message-box {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff9800;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
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
            background-color: #ff9800;
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

        .empty-wishlist {
            color: #777;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fa-solid fa-heart"></i> Wishlist</h2>

        <div class="message-box" id="wishlist-message"></div>

        @if(empty($wishlist))
            <p class="empty-wishlist">Your wishlist is empty. <i class="fa-solid fa-box-open"></i></p>
        @else
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @foreach($wishlist as $id => $item)
                    <tr>
                        <td><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>₹{{ number_format($item['price'], 2) }}</td>
                        
                        <td>
                            <form action="{{ route('wishlist.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn-danger"><i class="fa-solid fa-trash"></i> Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-to-wishlist").click(function() {
                var product_id = $(this).data("id");
                var name = $(this).data("name");
                var price = $(this).data("price");
                var image = $(this).data("image");

                $.ajax({
                    url: "{{ route('wishlist.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        name: name,
                        price: price,
                        image: image
                    },
                    success: function(response) {
                        $("#wishlist-message").text(response.message).fadeIn().delay(2000).fadeOut();
                    }
                });
            });
        });
    </script>
</body>
</html>

@include('layouts.footer')
