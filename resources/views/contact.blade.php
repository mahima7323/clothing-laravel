@include('layouts.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Fashion Hub</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .contact-info {
            margin: 15px 0;
            font-size: 18px;
            color: #555;
        }

        .contact-info p {
            margin: 5px 0;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>

<body>
   
    <div class="container">
        <h2>Get in Touch</h2>
        <p>If you have any questions or need assistance, feel free to reach out to us using the details below:</p>

        <div class="contact-info">
            <p><strong>Email:</strong> support@fashionhub.com</p>
            <p><strong>Phone:</strong> +1 (123) 456-7890</p>
            <p><strong>Address:</strong> 123 Fashion St, New York, NY 10001</p>
            <p><strong>Working Hours:</strong> Mon - Fri: 9:00 AM - 6:00 PM</p>
        </div>
    </div>

    
</body>

</html>


@include('layouts.footer')