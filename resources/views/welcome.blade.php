@include('layouts.header')
<center>
<h1> Home Page</h1>
</center>

<div class="slider-container">
    <div class="slider">
        <div class="slide">
            <img src="https://plus.unsplash.com/premium_photo-1664202526559-e21e9c0fb46a?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmFzaGlvbnxlbnwwfHwwfHx8MA%3D%3D" alt="Fashion 1">
        </div>
        <div class="slide">
            <img src="https://media.istockphoto.com/id/1388251737/photo/young-women-at-swap-party-casual-clothes-shoes-hats-bags-jewellery.jpg?s=612x612&w=0&k=20&c=aAwbo6GZR_irJboK0wd1lCWWRAXbMcLeM3GmeQD7_4Q=" alt="Fashion 2">
        </div>
        <div class="slide">
            <img src="https://t3.ftcdn.net/jpg/04/04/14/26/360_F_404142602_Y2wuSHD5janWigIQiLDF3LcRW6ZTMD6k.jpg" alt="Fashion 3">
        </div>
    </div>
</div>



@include('layouts.footer')

<style>
    /* Slider container */
    .slider-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        margin: 20px 0;
        height: 400px; /* Set a fixed height for the slider */
    }

    /* Slider */
    .slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 300%;
    }

    /* Individual slide */
    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }

    .slide img {
        width: 100%;
        height: 100%; /* Ensure the image fills the slider height */
        object-fit: cover; /* Crop the image to fit the container without distortion */
        display: block;
    }

    /* Optional: Add navigation dots */
    .dots {
        text-align: center;
        margin-top: 10px;
    }

    .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 0 5px;
        background-color: #ccc;
        border-radius: 50%;
        cursor: pointer;
    }

    .dot.active {
        background-color: #3498db;
    }
</style>

<script>
    let currentIndex = 0;

    function showSlide(index) {
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        if (index >= slides.length) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = slides.length - 1;
        } else {
            currentIndex = index;
        }

        slider.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Update dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    function autoSlide() {
        showSlide(currentIndex + 1);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const dotsContainer = document.createElement('div');
        dotsContainer.classList.add('dots');

        const slides = document.querySelectorAll('.slide');
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => showSlide(index));
            dotsContainer.appendChild(dot);
        });

        document.querySelector('.slider-container').appendChild(dotsContainer);

        setInterval(autoSlide, 6000); // Change slide every 3 seconds
    });
</script>