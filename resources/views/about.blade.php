@include('layouts.header')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
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
            max-width: 1000px;
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

        p {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .mission, .vision {
            margin: 20px 0;
            padding: 20px;
            background-color: #eee;
            border-radius: 5px;
        }

        .team {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .member {
            text-align: center;
            margin: 10px;
        }

        .member img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
                <!-- <img src="https://via.placeholder.com/180" alt="Alice"> -->
                <h3>Mahima Thaker</h3>
                <!-- <p>Founder & CEO</p> -->
            </div>
            <div class="member">
                <!-- <img src="https://via.placeholder.com/180" alt="David"> -->
                <h3>Sanjana Mali</h3>
                <!-- <p>Creative Director</p> -->
            </div>
            <div class="member">
                <!-- <img src="https://via.placeholder.com/180" alt="Sophia"> -->
                <h3>Shruti Lad</h3>
                <!-- <p>Marketing Manager</p> -->
            </div>
            <div class="member">
                <!-- <img src="https://via.placeholder.com/180" alt="Lucas"> -->
                <h3>Yatisha Bhagat</h3>
                <!-- <p>Product Designer</p> -->
            </div>
        </div>
    </div>

   
</body>

</html>


@include('layouts.footer')