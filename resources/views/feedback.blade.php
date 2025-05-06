@include('layouts.header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .star-rating {
            direction: rtl;
            font-size: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
            padding: 0 5px;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }

        .input-group-text {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="feedback-container">
            <h3 class="text-center mb-4">We Value Your Feedback</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('feedback.submit') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Rating -->
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div class="star-rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}">
                            <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                    </div>
                    @error('rating') <small class="text-danger d-block text-center">{{ $message }}</small> @enderror
                </div>

                <!-- Message -->
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-comment-dots"></i></span>
                        <textarea name="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-paper-plane me-1"></i> Submit Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

@include('layouts.footer')
