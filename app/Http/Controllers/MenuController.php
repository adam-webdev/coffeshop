<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::get();
        $kategori = Kategori::all();
        return view('admin.menu.index', compact("menu", "kategori"));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        // ddd($request->all());
        // $request->validate([
        //     'foto' => 'required|file|mimes:jpeg,png,jpg,gif|size:5000'
        // ]);


        $foto = $request->file('foto');
        if ($foto) {
            $originalName = $foto->getClientOriginalName();
            $unikName = time() . "-" . $originalName;
            $fotoMenu = $foto->storeAs('menu', $unikName);
        }

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->stok = $request->stok;
        $menu->harga = $request->harga;
        $menu->status = $request->status;
        $menu->kategori_id = $request->kategori_id;
        $menu->foto = $fotoMenu;
        $menu->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('menu.index');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategori = Kategori::all();

        return view("admin.menu.edit", compact('menu', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'foto' => 'file|mimetypes:image/jpeg,image/png,image/jpg,image/gif|'
        // ]);
        $menu = Menu::findOrFail($id);
        $inputfoto = $request->file('foto');
        if ($inputfoto) {
            // jika ada request banner hapus yang lama di storage
            if (Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }
            $originalName = $inputfoto->getClientOriginalName();
            $unikName = time() . "-" . $originalName;
            $fotoMenu = $inputfoto->storeAs('menu', $unikName);
        } else {
            $fotoMenu = $menu->foto;
        }

        $menu->nama = $request->nama;
        $menu->stok = $request->stok;
        $menu->harga = $request->harga;
        $menu->kategori_id = $request->kategori_id;
        $menu->foto = $fotoMenu;
        $menu->status = $request->status;
        $menu->save();

        Alert::success('Terupdate', 'Data Berhasil Diupdate');
        return redirect()->route('menu.index');
    }


    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        if (Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }
        $menu->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('menu.index');
    }
}