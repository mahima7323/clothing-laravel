<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - User Panel</title>
    <style>
        /* Add your custom styling here */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .settings-header {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .user-info, .order-history, .change-password {
            margin-bottom: 40px;
        }

        .order-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-history table, th, td {
            border: 1px solid #ddd;
        }

        .order-history th, td {
            padding: 12px;
            text-align: left;
        }

        .order-history th {
            background-color: #f4f4f4;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        .success-message {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="settings-header">
        Settings
    </div>

    <!-- User Info Section -->
    <div class="user-info">
        <h3>User Information</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->cno ?? 'N/A' }}</p>
        <p><strong>Gender:</strong> {{ $user->gender ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $user->city ?? 'N/A' }}</p>
    </div>

    <!-- Order History Section -->
    <div class="order-history">
        <h3>Order History</h3>
        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You have not placed any orders yet.</p>
        @endif
    </div>

    <!-- Change Password Section -->
    <div class="change-password">
        <h3>Change Password</h3>

        <!-- Display Success or Error Message -->
        @if(session('status'))
            <div class="success-message">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Password Change Form -->
        <form action="{{ route('user.changePassword') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" required>
            </div>

            <button type="submit">Update Password</button>
        </form>
    </div>
</div>

</body>
</html>
