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
        $reseps = Resep::all();
        return view('resep', compact ('reseps'));
    }
    public function detail($id)
    {
        $reseps = Resep::where('id', $id)->first();
        return view('detailresep', compact ('reseps'));
    }
}
