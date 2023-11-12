<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Http\Requests\StoreKomenRequest;
use App\Http\Requests\UpdateKomenRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class KomenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['content' => 'required|min:1']);

        $input = request()->except(['_token']);

        Komen::create($input);

        return back();
    }
}
