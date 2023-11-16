<?php

namespace App\Http\Controllers;

//import Model "Makanan"
use App\Models\Makanan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get makanans
        $makanans = Makanan::latest()->paginate(5);

        //render view with makanans
        return view('makanans.index', compact('makanans'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('makanans.create');
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
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'deskripsi'     => 'required|min:10',
            'content'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/makanan', $image->hashName());

        //create makanan
        Makanan::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'deskripsi'   =>$request->deskripsi,
            'content'   => $request->content
        ]);

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get makanan by ID
        $makanans = Makanan::findOrFail($id);

        //render view with makanan
        return view('makanans.edit', compact('makanans'));
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
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'deskripsi' => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //get makanan by ID
        $makanans = Makanan::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/makanan', $image->hashName());

            //delete old image
            Storage::delete('public/makanan/'.$makanans->image);

            //update makanan with new image
            $makanans->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'deskripsi' => $request->deskripsi,
                'content'   => $request->content
            ]);

        } else {

            //update makanan without image
            $makanans->update([
                'title'     => $request->title,
                'deskripsi' => $request->deskripsi,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $makanan
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get makanan by ID
        $makanan = Makanan::findOrFail($id);

        //delete image
        Storage::delete('public/makanans/'. $makanan->image);

        //delete makanan
        $makanan->delete();

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('cari');

        // mengambil data dari table makanan sesuai pencarian data
        // $makanans = Makanan::where('title', 'like', "%" . $keyword . "%")->paginate(5);
        $makanans = Makanan::where('title', 'like', "%" . $keyword . "%")->orderBy('id', 'desc')->paginate(5);
        $makanans->appends(['cari' => $keyword]);

        // mengirim data makanan ke view index
        return view('makanans.index', compact('makanans'));
    }
}
