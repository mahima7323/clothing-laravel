@include('layouts.header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Fashion Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
        }

        .contact-container {
            max-width: 900px;
            margin: 60px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }

        .contact-left, .contact-right {
            padding: 40px;
            flex: 1 1 50%;
        }

        .contact-left {
            background-color: #007bff;
            color: white;
        }

        .contact-left h2 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .contact-left p {
            font-size: 16px;
            margin: 15px 0;
            color: #e0e0e0;
        }

        .contact-left i {
            color: #fff;
            margin-right: 12px;
        }

        .contact-right h2 {
            font-size: 26px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .contact-right p.description {
            font-size: 15px;
            color: #555;
            margin-bottom: 30px;
        }

        .contact-right p {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }

            .contact-left, .contact-right {
                flex: 1 1 100%;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

<div class="contact-container">
    <div class="contact-left">
        <h2>Contact Info</h2>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> mahimathaker.mca24@scet.ac.in</p>
        <p><i class="fas fa-phone"></i> <strong>Phone:</strong> +91 9157396433</p>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 123 Fashion St, Surat</p>
        <p><i class="fas fa-calendar-alt"></i> <strong>Working Days:</strong> Mon - Fri</p>
        <p><i class="fas fa-clock"></i> <strong>Working Hours:</strong> 9:00 AM - 8:00 PM</p>
    </div>
    <div class="contact-right">
        <h2>Get in Touch</h2>
        <p class="description">We’d love to hear from you. Send us your questions, feedback, or suggestions and we’ll get back to you as soon as possible.</p>
        <p><i class="fas fa-smile"></i> Thank you for supporting Fashion Hub!</p>
    </div>
</div>

</body>
</html>

@include('layouts.footer')
