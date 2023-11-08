<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
class WelcomeController extends Controller
{
    public function index()
    {
        $makanans = Makanan::paginate(12);
        return view('welcome', compact ('makanans'));
    }
    public function detail($id)
    {
        $makanans = Makanan::where('id', $id)->first();
        return view('detailmakanan', compact ('makanans'));
    }
    public function cari(Request $request)
    {
        $keyword = $request->input('cari');

        // mengambil data dari table makanan sesuai pencarian data
        $makanans = Makanan::where('title', 'like', "%" . $keyword . "%")->orderBy('id', 'desc')->paginate(12);
        $makanans->appends(['cari' => $keyword]);

        // mengirim data makanan ke view index
        return view('welcome', compact('makanans'));
    }
}
