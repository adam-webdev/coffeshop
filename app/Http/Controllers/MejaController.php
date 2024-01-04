<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MejaController extends Controller
{
    public function index()
    {
        $meja = Meja::get();
        return view('admin.meja.index', compact("meja"));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $meja = new Meja();
        $meja->nama = $request->nama;
        $meja->kursi = $request->kursi;
        $meja->status = $request->status;
        $meja->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('meja.index');
    }

    public function edit($id)
    {
        $meja = Meja::findOrFail($id);
        return view("admin.meja.edit", compact('meja'));
    }


    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);
        $meja->nama = $request->nama;
        $meja->kursi = $request->kursi;
        $meja->status = $request->status;
        $meja->save();
        Alert::success('Terupdate', 'Data Berhasil Diupdate');
        return redirect()->route('meja.index');
    }


    public function delete($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('meja.index');
    }
}