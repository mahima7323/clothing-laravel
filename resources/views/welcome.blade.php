@include('layouts.header')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
    }

    h1 {
        text-align: center;
        margin: 30px 0;
        font-size: 2.5rem;
        color: #333;
    }

    .slider-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
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
    }

    .dots {
        text-align: center;
        margin: 15px 0;
    }

    .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin: 0 6px;
        background-color: #ccc;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .dot.active {
        background-color: #007bff;
    }

    @media (max-width: 768px) {
        .slide img {
            height: 300px;
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
</style>

<h1>Welcome to Our Fashion Store</h1>

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

        setInterval(autoSlide, 5000); // 5 seconds auto-slide
    });
</script>
