<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
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
            color: #2c3e50;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .empty-wishlist {
            color: #666;
            font-size: 18px;
            margin-top: 20px;
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
            background-color: #2c3e50;
            color: white;
        }

        td img {
            width: 50px;
            height: auto;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #c0392b;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-right: 5px;
        }

        .btn-danger:hover {
            background-color: #96281b;
        }

        .btn-dark {
            background-color: #2c3e50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #1a252f;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    @include('layouts.header') {{-- ✅ Move here after <body> --}}

    <div class="container">
        <h2><i class="fa-solid fa-heart"></i> Wishlist</h2>

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
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlist as $item)
                        @if($item->product)
                            <tr>
                                <td>
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">


                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>₹{{ number_format($item->product->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('wishlist.remove') }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->product->id }}">
                                        <button class="btn-danger"><i class="fa-solid fa-trash"></i> Remove</button>
                                    </form>

                                    <form action="{{ route('cart.add.from.wishlist', ['id' => $item->product->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn-dark">
                                            <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    @include('layouts.footer') {{-- ✅ Should be inside <body> too --}}

</body>
</html>
