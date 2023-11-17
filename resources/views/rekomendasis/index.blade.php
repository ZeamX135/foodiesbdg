<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page - Rekomendasi</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    {{-- Navbar start --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Data Rekomendasi') }}
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
                                {{-- <a href="{{ route('rekomendasi.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                    POST</a> --}}

                                <div class="d-flex w-100" style="justify-content: end">

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
                                    @forelse ($rekomendasis as $rekomendasi)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('/storage/rekomendasi/' . $rekomendasi->image) }}"
                                                    class="rounded" style="width: 150px">
                                            </td>
                                            <td>{{ $rekomendasi->title }}</td>
                                            <td>{!! $rekomendasi->deskripsi !!}</td>
                                            <td>{!! Str::limit($rekomendasi->content, 50) !!}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('rekomendasi.destroy', $rekomendasi->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('rekomendasi.edit', $rekomendasi->id) }}"
                                                        class="btn btn-sm btn-primary">EDIT</a>
                                                    {{-- @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">HAPUS</button> --}}
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
                            {{ $rekomendasis->links() }}
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
