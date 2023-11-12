<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page - Makanan</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    {{-- Navbar start --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Data') }}
            </h2>
        </x-slot>
        {{-- Navbar end --}}

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">


                        <div class="card-body">
                            <div class="d-flex" style="justify-content: space-between;">
                                <a href="{{ route('makanan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                    POST</a>

                                <div class="d-flex" style="width: 450px;">
                                    <form action="{{ route('makanan.cari') }}" method="GET" style="right: 10px;"
                                        class="me-3 rounded-full row ">
                                        <input type="text" name="cari" placeholder="Cari Judul"
                                            value="{{ old('cari') }}" class="form-control col-7 w-100">
                                        <input type="submit" value="Search" class="col-3 btn btn-primary"
                                            style="height: 39px; width: 150px; background-color: blue">
                                    </form>

                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-md btn-dark mb-3 float-right ms-2">KEMBALI</a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">GAMBAR</th>
                                        <th scope="col">JUDUL</th>
                                        <th scope="col">DESKRIPSI</th>
                                        <th scope="col">CONTENT</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($makanans as $makanan)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('/storage/makanan/' . $makanan->image) }}"
                                                    class="rounded" style="width: 150px">
                                            </td>
                                            <td>{{ $makanan->title }}</td>
                                            <td>{!! $makanan->deskripsi !!}</td>
                                            <td>{!! Str::limit($makanan->content, 50) !!}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('makanan.destroy', $makanan->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('makanan.edit', $makanan->id) }}"
                                                        class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Post belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $makanans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    </x-app-layout>
</body>

</html>
