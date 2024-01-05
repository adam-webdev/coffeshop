<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = Kategori::orderBy('id', 'desc')->get()();
        return view('admin.kategori.index', compact("kategori"));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->status = $request->status;
        $kategori->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('kategori.index');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view("admin.kategori.edit", compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->nama = $request->nama;
        $kategori->status = $request->status;
        $kategori->save();
        Alert::success('Terupdate', 'Data Berhasil Diupdate');
        return redirect()->route('kategori.index');
    }


    public function delete($id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('kategori.index');
    }
}
