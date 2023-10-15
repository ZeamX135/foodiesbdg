<?php

namespace App\Http\Controllers;

//import Model "Resep"
use App\Models\Resep;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get reseps
        $reseps = Resep::latest()->paginate(5);

        //render view with reseps
        return view('reseps.index', compact('reseps'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('reseps.create');
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
        $image->storeAs('public/resep', $image->hashName());

        //create resep
        Resep::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'deskripsi'   =>$request->deskripsi,
            'content'   => $request->content
        ]);

        //redirect to index
        return redirect()->route('resep.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get resep by ID
        $reseps = Resep::findOrFail($id);

        //render view with resep
        return view('reseps.edit', compact('reseps'));
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
            'content'   => 'required|min:10'
        ]);

        //get resep by ID
        $reseps = Resep::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/resep', $image->hashName());

            //delete old image
            Storage::delete('public/resep/'.$reseps->image);

            //update resep with new image
            $reseps->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            //update resep without image
            $reseps->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('resep.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $resep
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get resep by ID
        $resep = Resep::findOrFail($id);

        //delete image
        Storage::delete('public/reseps/'. $resep->image);

        //delete resep
        $resep->delete();

        //redirect to index
        return redirect()->route('resep.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
