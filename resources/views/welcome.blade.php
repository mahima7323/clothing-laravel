@include('layouts.header')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f0f2f5, #e3eaf3);
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin: 40px 0;
        font-size: 3rem;
        color: #2c3e50;
        font-weight: 700;
    }

    .slider-container {
        width: 90%;
        max-width: 1200px;
        margin: 30px auto;
        overflow: hidden;
        position: relative;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        background: #fff;
    }

    .slider {
        display: flex;
        transition: transform 0.7s ease-in-out;
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }

    .slide img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        display: block;
        border-radius: 20px 20px 0 0;
    }

    .dots {
        text-align: center;
        padding: 15px;
        background: #fff;
        border-radius: 0 0 20px 20px;
    }

    .dot {
        display: inline-block;
        width: 15px;
        height: 15px;
        margin: 0 8px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .dot:hover {
        transform: scale(1.2);
        background-color: #3498db;
    }

    .dot.active {
        background-color: #3498db;
        width: 18px;
        height: 18px;
    }

    @media (max-width: 768px) {
        .slide img {
            height: 300px;
        }
        h1 {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 480px) {
        .slide img {
            height: 200px;
        }
        h1 {
            font-size: 1.8rem;
        }
    }

    /* New color scheme for CTA section */
    .cta-container {
        background: #9b59b6;  /* Purple background */
        color: white;
        padding: 50px 0;
        text-align: center;
        border-radius: 20px;
        margin-top: 30px;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .cta-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    .cta-button {
        background: #fff;
        color: #9b59b6;  /* Matching button color */
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        background: #8e44ad;  /* Darker purple on hover */
        color: #fff;
    }
</style>

<h1>Welcome to Our Fashion Store ✨</h1>

<div class="slider-container">
    <div class="slider">
        <div class="slide">
            <img src="https://plus.unsplash.com/premium_photo-1664202526559-e21e9c0fb46a?fm=jpg&q=60&w=3000" alt="Fashion 1">
        </div>
        <div class="slide">
            <img src="https://www.shutterstock.com/image-photo/fashionable-clothes-boutique-store-london-600nw-589577570.jpg" alt="Fashion 2">
        </div>
        <div class="slide">
            <img src="https://t3.ftcdn.net/jpg/04/04/14/26/360_F_404142602_Y2wuSHD5janWigIQiLDF3LcRW6ZTMD6k.jpg" alt="Fashion 3">
        </div>
    </div>
    <div class="dots"></div>
</div>

<div class="cta-container">
    <div class="cta-content">
        <h2>Discover Our Latest Collection</h2>
        <p>Explore the trends of this season. Browse through our newest arrivals and elevate your wardrobe today!</p>
        <a href="/product_list" class="cta-button">Shop Now</a>
    </div>
</div>

@include('layouts.footer')

<script>
    let currentIndex = 0;

    function showSlide(index) {
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        if (index >= slides.length) currentIndex = 0;
        else if (index < 0) currentIndex = slides.length - 1;
        else currentIndex = index;

        slider.style.transform = `translateX(-${currentIndex * 100}%)`;

        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    function autoSlide() {
        showSlide(currentIndex + 1);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const dotsContainer = document.querySelector('.dots');
        const slides = document.querySelectorAll('.slide');

        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => showSlide(index));
            dotsContainer.appendChild(dot);
        });

        setInterval(autoSlide, 4000); // Auto-slide every 4 seconds
    });
</script>
