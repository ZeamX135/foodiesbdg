<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class WelcomeController extends Controller
{
    public function index()
    {
        $makanans = Makanan::latest()->paginate(24);
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
        $makanans = Makanan::where('title', 'like', "%" . $keyword . "%")->orderBy('id', 'desc')->paginate(24);
        $makanans->appends(['cari' => $keyword]);

        // mengirim data makanan ke view index
        return view('welcome', compact('makanans'));
    }

    public function store(Request $request): RedirectResponse
    {

//validate form
        $this->validate($request, ['content' => 'required|min:10']);
    //create post

    Komen::create(['content' => $request->content]);

    //redirect to index

    return
    redirect()->back()->with(['success' => 'Terimakasih atas Saran Anda!']);
    }
}
