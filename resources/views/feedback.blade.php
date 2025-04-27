@include('layouts.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Fashion Hub</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: black;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            font-size: 1.1rem;
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 1rem;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .contact-info {
            margin-top: 40px;
            text-align: center;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-info h3 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 1.1rem;
            color: #555;
        }

        .contact-info p i {
            color: #007bff;
            margin-right: 10px;
            width: 20px;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: #fff;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px 20px;
            }

            h2 {
                font-size: 2rem;
            }

            form input,
            form textarea {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Get in Touch</h2>
        <p>If you have any questions, feedback, or inquiries, feel free to reach out to us. We’d love to hear from you!</p>

        <form action="/submit-contact" method="post">
            @csrf

            <label for="name">Your Name</label>
            <!-- Automatically fill the name if the user is logged in -->
            <input type="text" id="name" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Enter your name" required>

            <label for="email">Your Email</label>
            <!-- Automatically fill the email if the user is logged in -->
            <input type="email" id="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="Enter your email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" placeholder="Write your message here" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <div class="contact-info">
            <h3>Contact Information</h3>
            <p><i class="fas fa-envelope"></i><strong>Email:</strong> fashion@gmail.com</p>
            <p><i class="fas fa-phone"></i><strong>Phone:</strong> +91 9157396433</p>
            <p><i class="fas fa-map-marker-alt"></i><strong>Address:</strong> 123 Fashion St, Surat</p>
        </div>
    </div>

</body>

</html>

@include('layouts.footer')
