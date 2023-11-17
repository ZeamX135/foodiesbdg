{{-- Navbar start --}}
<nav class="navbar navbar-expand-lg shadow-sm ">
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
