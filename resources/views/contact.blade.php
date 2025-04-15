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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .contact-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-container h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .contact-container p.description {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .contact-info {
            text-align: left;
        }

        .contact-info p {
            font-size: 17px;
            margin: 15px 0;
            color: #333;
        }

        .contact-info i {
            color: #007bff;
            margin-right: 10px;
            width: 20px;
        }

        @media (max-width: 600px) {
            .contact-container {
                padding: 25px 20px;
            }

            .contact-container h2 {
                font-size: 24px;
            }

            .contact-info p {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="contact-container">
        <h2>Get in Touch</h2>
        <p class="description">Have questions, feedback, or need assistance? Reach out to us — we’re here to help!</p>

        <div class="contact-info">
            <p><i class="fas fa-envelope"></i><strong>Email:</strong> fashion@gmail.com</p>
            <p><i class="fas fa-phone"></i><strong>Phone:</strong> +91 9157396433</p>
            <p><i class="fas fa-map-marker-alt"></i><strong>Address:</strong> 123 Fashion St, Surat</p>
            <p><i class="fas fa-calendar-alt"></i><strong>Working Days:</strong> Mon - Fri</p>
            <p><i class="fas fa-clock"></i><strong>Working Hours:</strong> 9:00 AM - 8:00 PM</p>
        </div>
    </div>

</body>

</html>

@include('layouts.footer')
