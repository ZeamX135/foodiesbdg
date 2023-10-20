<!DOCTYPE html>

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
                    <a class="nav-link" href="/pageresep">Resep</a>
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
                Selamat datang di
            </p>
            <p>
                Foodies<span>.bdg</span>
            </p>
        </main>
    </section>
    <!-- Hero Section end -->

    {{-- Content Start --}}
    <div id="rekomendasi" class="makanan" style="display: flex; flex-wrap: wrap; width: 93.5rem; ">
        @foreach ($makanans as $makanan)
            <div class="" style="margin-top: 50px">
                <img src="{{ asset('/storage/makanan/' . $makanan->image) }}" class="card-img-top contentimg"
                    alt="...">
                <div class="card-body contenttitle">
                    <a href="{{ route('detailmakanan', $makanan->id) }}" h5 class="card-text">{{ $makanan->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Content End --}}

</body>


</html>
