<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Komen;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        //get posts
        $komen = Komen::latest()->paginate(5);
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        //render view with posts
        return view('dashboard', compact('komen'));

    }

    /**
     * destroy
     *
     * @param  mixed $komen
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get komen by ID
        $komen = Komen::findOrFail($id);

        //delete komen
        $komen->delete();

        //redirect to index
        alert()->success('Masukkan Berhasil Dihapus');
        return redirect()->back();
    }
}
