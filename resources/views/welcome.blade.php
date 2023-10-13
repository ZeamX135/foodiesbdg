<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BandungCulinaryDelight</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app.css') }}">

</head>

<body>
    {{-- Navbar start --}}
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#">Foodies<span>.bdg</span></a>
            <ul class="navbar-nav me-5 d-flex">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rekomendasi">Rekomendasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#khas">Resep</a>
                </li>
            </ul>
        </div>
    </nav>
    {{-- Navbar end --}}

    <!-- Hero Section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Foodies<span>.bdg</span></h1>
            <p>
                <span>Selamat datang</span> di Foodies<span>.bdg</span>
            </p>
            <p>
                Rempah-rempah yang berbeda
                untuk selera yang berbeda
            </p>
            <a href="#" class="cta">learn more</a>
        </main>
    </section>
    <!-- Hero Section end -->
</body>

</html>
