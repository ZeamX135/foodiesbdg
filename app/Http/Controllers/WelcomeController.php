<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
class WelcomeController extends Controller
{
    public function index()
    {
        $makanans = Makanan::all();
        return view('welcome', compact ('makanans'));
    }
    public function detail($id)
    {
        $makanans = Makanan::where('id', $id)->first();
        return view('detailmakanan', compact ('makanans'));
    }
}
