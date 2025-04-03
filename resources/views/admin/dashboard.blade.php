@include('layouts.ad_header')
@extends('layouts.admin_header')

@section('content')
<div class="header">
    <h2>Admin Dashboard</h2>
    <p>Welcome to the Admin Dashboard. Manage your store efficiently.</p>
</div>

<div class="cards">
    <div class="card">
        <h3>Total Products</h3>
        <p>120</p>
    </div>

    <div class="card">
        <h3>Total Users</h3>
        <p>350</p>
    </div>

    <div class="card">
        <h3>Total Orders</h3>
        <p>85</p>
    </div>

    <div class="card">
        <h3>Total Revenue</h3>
        <p>45,000/-</p>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<style>
    body, html {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1; /* Takes up remaining space */
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
        margin-top: auto; /* Pushes footer to the bottom */
        box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
    }

    .footer-content h3 {
        font-size: 24px;
        margin-bottom: 10px;
        font-weight: bold;
        color: #e74c3c;
    }

    .footer-content p {
        font-size: 16px;
        margin-bottom: 20px;
        color: #ccc;
    }

    .socials {
        list-style: none;
        padding: 0;
        margin: 20px 0;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .socials li {
        display: inline-block;
    }

    .socials a {
        text-decoration: none;
        color: #fff;
        font-size: 18px;
        padding: 8px 12px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .socials a:hover {
        background-color: #555;
    }

    .footer-bottom {
        margin-top: 20px;
        font-size: 14px;
        color: #bbb;
    }

    .footer-bottom a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }

    .footer-bottom a:hover {
        text-decoration: underline;
    }

    .cards {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: nowrap; /* Prevents wrapping */
    }

    .card {
        background-color: #444;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        color: #f4f4f4;
        text-align: center;
        width: 200px;
        flex-shrink: 0; /* Prevents shrinking */
    }

    .card h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .card p {
        font-size: 18px;
    }

</style>
<main>
    @yield('content')
</main>

@include('layouts.footer')

@endsection
