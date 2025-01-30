<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>e-Tiket Wisata</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDV8fGJlYWNofGVufDB8fHx8MTY4OTQ4Njg5Mg&ixlib=rb-1.2.1&q=80&w=1920') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }

    .overlay {
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .hero {
        position: relative;
        z-index: 1;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
    }

    .hero h1 {
        font-size: 4rem;
        margin-bottom: 1rem;

    }

    .hero p {
        font-size: 1.5rem;
        margin-bottom: 2rem;

    }

    .hero a {
        display: inline-block;
        margin: 0 10px;
        padding: 10px 20px;
        font-size: 1.2rem;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid #fff;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .hero a:hover {
        background: #fff;
        color: #333;
    }

    .footer {
        text-align: center;
        padding: 1rem 0;
        background: rgba(0, 0, 0, 0.7);
        position: absolute;
        width: 100%;
        bottom: 0;
        color: #fff;
        font-size: 0.9rem;
    }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="hero">
        <div>
            <h1>Welcome to e-Tiket Wisata</h1>
            <p>Your gateway to explore the most beautiful destinations</p>
        </div>

        <div>
            @if (Route::has('login'))
            @auth
            <a href="/dashboard">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
            @endif
        </div>
    </div>

</body>

</html>