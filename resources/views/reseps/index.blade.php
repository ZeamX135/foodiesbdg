<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page - Resep</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="d-flex" style="justify-content: space-between;">
                            <a href="{{ route('resep.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>

                            <div class="d-flex" style="width: 450px;">
                                <form action="{{ route('resep.cari') }}" method="GET" style="right: 10px;"
                                    class="mt-1 mx-auto max-w-xl  rounded-full">
                                    <input type="text" name="cari" placeholder="Cari Judul"
                                        value="{{ old('cari') }}" class=" pr-4 ">
                                    <input type="submit" value="Search" class="">
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
                                @forelse ($reseps as $resep)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/resep/' . $resep->image) }}" class="rounded"
                                                style="width: 150px">
                                        </td>
                                        <td>{{ $resep->title }}</td>
                                        <td>{{ $resep->deskripsi }}</td>
                                        <td>{!! $resep->content !!}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('resep.destroy', $resep->id) }}" method="POST">
                                                <a href="{{ route('resep.edit', $resep->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
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
                        {{ $reseps->links() }}
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

</body>

</html>
