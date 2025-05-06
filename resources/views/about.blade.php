@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f2f5, #e3eaf3);
        }

        .hero-section {
            height: 500px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/fashion-banner.jpg") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            padding: 0 20px;
            animation: fadeIn 1s ease;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero-content p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .about-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .mission-vision-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            margin: 60px 0;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #ff6b6b, #ffd93d);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .card h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #2d3436;
        }

        .card p {
            color: #636e72;
            line-height: 1.8;
        }

        .team-section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .team-member {
            position: relative;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .member-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-member:hover .member-image img {
            transform: scale(1.1);
        }

        .member-info {
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .member-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #ff6b6b, #ffd93d);
        }

        .member-info h3 {
            font-size: 1.5rem;
            color: #2d3436;
            margin: 15px 0 5px;
        }

        .member-info p {
            color: #636e72;
            font-size: 1rem;
            margin: 5px 0;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            color: #636e72;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: #ff6b6b;
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .mission-vision-container {
                grid-template-columns: 1fr;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="hero-section">
        <div class="hero-content">
            <h1>Fashion Hub</h1>
            <p>Crafting timeless style through innovation and sustainability</p>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="mission-vision-container">
                <div class="card">
                    <h2>Our Mission</h2>
                    <p>To deliver high-quality fashion at affordable prices while promoting sustainable and ethical practices in the fashion industry.</p>
                </div>
                <div class="card">
                    <h2>Our Vision</h2>
                    <p>To become a global leader in the fashion e-commerce space, empowering individuals to express their unique style.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                    <img src="{{ asset('storage/products/team/a1.jpg') }}" alt="Mahima Thaker">
                    </div>
                    <div class="member-info">
                        <h3>Mahima Thaker</h3>
                        <p>Founder & CEO</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-image">
                    <img src="{{ asset('storage/products/team/a2.jpg') }}" alt="Sanjana Mali">
                    </div>
                    <div class="member-info">
                        <h3>Sanjana Mali</h3>
                        <p>Creative Director</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-image">
                    <img src="{{ asset('storage/products/team/a3.jpg') }}" alt="Shruti Lad">
                    </div>
                    <div class="member-info">
                        <h3>Shruti Lad</h3>
                        <p>Marketing Manager</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-image">
                    <img src="{{ asset('storage/products/team/a4.jpg') }}" alt="Yatisha Bhagat">
                    </div>
                    <div class="member-info">
                        <h3>Yatisha Bhagat</h3>
                        <p>Product Designer</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
@include('layouts.footer')