@include('layouts.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f2f5, #e3eaf3);
        }

        header {
            background-color: black; /* Original header color retained */
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: 700;
        }

        p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #555;
        }

        .mission, .vision {
            margin: 20px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mission h2, .vision h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .team {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 40px;
        }

        .member {
            text-align: center;
            margin: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .member:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .member img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .member img:hover {
            transform: scale(1.1);
        }

        .member h3 {
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: 600;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: #fff;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Welcome to Fashion Hub</h2>
        <p>Fashion Hub is your one-stop destination for trendy, stylish, and affordable clothing. We pride ourselves on curating the latest fashion collections that fit every personality and lifestyle.</p>

        <div class="mission">
            <h2>Our Mission</h2>
            <p>To deliver high-quality fashion at affordable prices while promoting sustainable and ethical practices in the fashion industry.</p>
        </div>

        <div class="vision">
            <h2>Our Vision</h2>
            <p>To become a global leader in the fashion e-commerce space, empowering individuals to express their unique style.</p>
        </div>

        <h2>Meet Our Team</h2>
        <div class="team">
            <div class="member">
            <img src="{{ asset('team/a1.jpg') }}" alt="Mahima Thaker">

                <h3>Mahima Thaker</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="member">
                <img src="https://via.placeholder.com/180" alt="Sanjana Mali">
                <h3>Sanjana Mali</h3>
                <p>Creative Director</p>
            </div>
            <div class="member">
                <img src="https://via.placeholder.com/180" alt="Shruti Lad">
                <h3>Shruti Lad</h3>
                <p>Marketing Manager</p>
            </div>
            <div class="member">
                <img src="C:\Users\Admin\Pictures\Camera Roll\a2.jpg" alt="Yatisha Bhagat">
                <h3>Yatisha Bhagat</h3>
                <p>Product Designer</p>
            </div>
        </div>
    </div>

</body>

</html>

@include('layouts.footer')
