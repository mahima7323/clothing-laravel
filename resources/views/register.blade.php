<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        /* General styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form container */
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        /* Form label and input fields */
        label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Submit button */
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Error messages */
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Registration Form</h2>

        <!-- Display success message -->
        @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display error messages -->
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
            @error('password_confirmation')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="cno">Contact No:</label>
            <input type="text" name="cno" value="{{ old('cno') }}">
            @error('cno')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="city">City:</label>
            <input type="text" name="city" value="{{ old('city') }}" required>
            @error('city')
            <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>