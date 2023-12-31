<?php

namespace App\Http\Controllers;

//import Model "Rekomendasi"
use App\Models\Rekomendasi;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekomendasiController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get rekomendasis
        $rekomendasis = Rekomendasi::latest()->paginate(5);

        //render view with rekomendasis
        return view('rekomendasis.index', compact('rekomendasis'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('rekomendasis.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:5000',
            'title'     => 'required|min:5',
            'deskripsi'     => 'required|min:10',
            'content'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/rekomendasi', $image->hashName());

        //create rekomendasi
        Rekomendasi::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'deskripsi'   =>$request->deskripsi,
            'content'   => $request->content
        ]);

        //redirect to index
        return redirect()->route('rekomendasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get rekomendasi by ID
        $rekomendasis = Rekomendasi::findOrFail($id);

        //render view with rekomendasi
        return view('rekomendasis.edit', compact('rekomendasis'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:5000',
            'title'     => 'required|min:5',
            'deskripsi' => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //get rekomendasi by ID
        $rekomendasis = Rekomendasi::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/rekomendasi', $image->hashName());

            //delete old image
            Storage::delete('public/rekomendasi/'.$rekomendasis->image);

            //update rekomendasi with new image
            $rekomendasis->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'deskripsi' => $request->deskripsi,
                'content'   => $request->content
            ]);

        } else {

            //update rekomendasi without image
            $rekomendasis->update([
                'title'     => $request->title,
                'deskripsi' => $request->deskripsi,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('rekomendasi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $rekomendasi
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get rekomendasi by ID
        $rekomendasi = Rekomendasi::findOrFail($id);

        //delete image
        Storage::delete('public/rekomendasis/'. $rekomendasi->image);

        //delete rekomendasi
        $rekomendasi->delete();

        //redirect to index
        return redirect()->route('rekomendasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('cari');

        // mengambil data dari table rekomendasi sesuai pencarian data
        // $rekomendasis = Rekomendasi::where('title', 'like', "%" . $keyword . "%")->paginate(5);
        $rekomendasis = Rekomendasi::where('title', 'like', "%" . $keyword . "%")->orderBy('id', 'desc')->paginate(5);
        $rekomendasis->appends(['cari' => $keyword]);

        // mengirim data rekomendasi ke view index
        return view('rekomendasis.index', compact('rekomendasis'));
    }
}
