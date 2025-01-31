<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Generator Sentana Teknologi">
    <meta name="author" content="Sentana Teknologi">
    <title>Web Tiket Wisata - Administrator</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" sizes="180x180">
    <link rel="manifest" href="/img/manifest.json">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/img/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
    </style>

    @yield('css')

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.navigation')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('breadcrumb')
                @include('layouts.alerts')
                @yield('content')
                <!-- footer section -->

                @include('layouts.footer')
            </main>
        </div>

    </div>



    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/feather.min.js"></script>
    <script defer>
    feather.replace({
        'aria-hidden': 'true'
    });
    </script>

    @yield('js')
</body>

</html>