@include('layouts.header')  <!-- Include header -->

<!-- Add custom styles directly on this page -->
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 60px auto;
        padding: 40px;
        background: linear-gradient(145deg, #ffffff, #f1f3f6);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        overflow: hidden;
    }

    .container:hover {
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        transform: translateY(-10px);
    }

    h2 {
        font-size: 2.5rem;
        color: #333;
        text-align: center;
        margin-bottom: 40px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'Roboto', sans-serif;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        font-weight: 600;
        color: #555;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1.1rem;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        font-family: 'Roboto', sans-serif;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #007bff;
        background-color: #fff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
    }

    .form-group input::placeholder,
    .form-group select option {
        color: #aaa;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 16px 26px;
        font-size: 1.2rem;
        border-radius: 8px;
        width: 100%;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }

    .alert {
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 10px;
        font-weight: bold;
        text-align: center;
        font-family: 'Roboto', sans-serif;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .text-danger {
        font-size: 0.875rem;
        color: #dc3545;
        position: absolute;
        bottom: -18px;
        left: 0;
    }

    /* Added smooth hover effect on form fields */
    .form-group input,
    .form-group select {
        transition: all 0.3s ease-in-out;
    }

    .form-group input:focus,
    .form-group select:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
        border-color: #007bff;
    }

    /* Added responsiveness */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 1.9rem;
        }

        .form-group input,
        .form-group select {
            padding: 12px;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }

    /* Additional Icon Styles */
    .form-group i {
        position: absolute;
        right: 15px;
        top: 15px;
        color: #007bff;
        font-size: 1.2rem;
    }
</style>

<div class="container">
    <h2>Edit Profile</h2>

    <!-- Display any success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Profile edit form -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your full name" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter your email address" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="cno">Contact No:</label>
            <input type="text" name="cno" id="cno" class="form-control" value="{{ old('cno', Auth::user()->cno) }}" placeholder="Enter your contact number">
            @error('cno') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" class="form-control">
                <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', Auth::user()->city) }}" placeholder="Enter your city">
            @error('city') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
    </form>
</div>

@include('layouts.footer')  <!-- Include footer -->
