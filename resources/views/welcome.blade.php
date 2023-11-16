<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>foodies.bdg</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('app.css') }}">

</head>

<body>
    @include('sweetalert::alert')
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
                    <a class="nav-link" href="#komen">Beri Masukkan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer">About</a>
                </li>
            </ul>
            <form action="{{ route('welcome.cari') }}" method="GET" style="right: 10px; color"
                class="my-auto me-3 rounded-full row ">
                <input type="text" name="cari" placeholder="Cari Nama Makanan" value="{{ old('cari') }}"
                    class="form-control col-6 w-75">
                <input type="submit" value="Search" class="col-3 btn btn-primary">
            </form>
        </div>
    </nav>
    {{-- Navbar end --}}

    <!-- Hero Section start -->
    <section class="" id="home">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner hero" style="max-height: 100vh">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ asset('img/herobg.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block content" style="bottom: 13rem">
                        <h1>Foodies<span>.bdg</span></h1>
                        <p>Selamat datang di</p>
                        <p>Foodies<span>.bdg</span></p>
                    </div>
                </div>
                <div class="carousel-item " data-bs-interval="3000">
                    <img src="{{ asset('img/slide2.png') }}" class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block" style="bottom: 7rem;">
                        <h1 style="text-align: left">Nasi Tutug Oncom <br>tertarik untuk mencoba?</h1>
                        <a style="float: left" class="btn btn-success" href="#rekomendasi">Lihat Daftar Makanan</a>
                    </div>
                </div>
                <div style="min-width: 100vh;" class="carousel-item" data-bs-interval="3000">
                    <img src="{{ asset('img/slide3.svg') }}" class="d-block w-100" style="object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block" style="bottom: 7rem;">
                        <h1 style="text-align: left">Siomay Bandung
                            <br>tertarik untuk membuat?
                        </h1>
                        <a style="float: left" class="btn btn-success" href="#rekomendasi">Lihat Resep</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    {{-- Content Start --}}

    <h3 id="rekomendasi" style="margin-top: 100px">ADA YANG RAME NIH!!</h3>
    <div class="makanan pb-5" style="display: flex; flex-wrap: wrap; width: 93.5rem; background-color: #00AA13 ">
        @foreach ($rekomendasis as $rekomendasi)
            <div style="margin-top: 50px">
                <a href="{{ route('detailrekomendasi', $rekomendasi->id) }}"><img
                        src="{{ asset('/storage/rekomendasi/' . $rekomendasi->image) }}"
                        class="card-img-top contentimg"></a>
                <div class="card-body contenttitle">
                    <a href="{{ route('detailrekomendasi', $rekomendasi->id) }}" h5
                        class="card-text">{{ $rekomendasi->title }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <h3 style="margin-top: 100px">DAFTAR MAKANAN</h3>

    <div class="makanan" style="display: flex; flex-wrap: wrap; width: 93.5rem; ">
        @foreach ($makanans as $makanan)
            <div class="" style="margin-top: 50px">
                <a href="{{ route('detailmakanan', $makanan->id) }}"><img
                        src="{{ asset('/storage/makanan/' . $makanan->image) }}" class="card-img-top contentimg"></a>
                <div class="card-body contenttitle">
                    <a href="{{ route('detailmakanan', $makanan->id) }}" h5
                        class="card-text">{{ $makanan->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="container" style="margin-top: 100px">
        {{ $makanans->links() }}
    </div>
    {{-- Content End --}}


    {{-- Komen Section Start --}}
    <form id="komen" action="{{ route('komen.store') }}" method="POST" enctype="multipart/form-data"
        style="margin-top: 200px">

        @csrf <div class="form-group">
            <h3>BERIKAN MASUKKAN ANDA</h3>
            <textarea class="container form-control @error('content') is-invalid @enderror" name="content" rows="5"
                placeholder="Masukkan Saran dan Masukkan Anda Di Sini">{{ old('content') }}</textarea>

            <!-- error message untuk content -->
            @error('content')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="container pt-2">
            <button type="submit" style="margin-left: 1060px" class="btn btn-md btn-info">SIMPAN</button>
        </div>

    </form>
    {{-- Komen Section End --}}

    {{-- Footer Start --}}
    <footer id="footer">
        <hr style="margin-bottom: 70px">
        <div class="container">
            <div class="footer-content-nav" style="width: 200px; margin-right: 150px">
                <h3>Blog</h3>
                <ul class="list">
                    <li><a href="#">Home</a></li>
                    <li><a href="#rekomendasi">Rekomendasi</a></li>
                    <li><a href="#komen">Beri Masukkan</a></li>
                    <li><a href="#footer">About</a></li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Power By</h3>
                <ul class="list">
                    <p>Foodies<span>.bdg</span></p>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Ikuti Kami</h3>
                <ul class="social-icons">
                    <li>
                        <a href="https://facebook.com/"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/home?lang=id"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                        <a
                            href="https://www.instagram.com/xiirpll23/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA=="><i
                                class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>Copyright &copy; 2023 QuantumCodeX</p>
        </div>
    </footer>
    {{-- Footer End --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>

</html>
