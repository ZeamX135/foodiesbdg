<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Makanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::paginate(24);
        return view('resep', compact ('reseps'));
    }
    public function detail($id)
    {
        $reseps = Resep::where('id', $id)->first();
        return view('detailresep', compact ('reseps'));
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('cari');

        // mengambil data dari table makanan sesuai pencarian data
        $reseps = Resep::where('title', 'like', "%" . $keyword . "%")->orderBy('id', 'desc')->paginate(24);
        $reseps->appends(['cari' => $keyword]);

        // mengirim data makanan ke view index
        return view('resep', compact('reseps'));
    }
}
