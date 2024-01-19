<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Ingredients;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IngredientsController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $bahanbaku = BahanBaku::all();
        $ingredients = Ingredients::with(['menu', 'bahanbaku'])->orderBy('id', 'desc')->get();
        return view('dapur.ingredients.index', compact("ingredients", "menu", "bahanbaku"));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $bahanbaku = $request->input('bahanbaku_id', []);
        $jumlah = $request->input('jumlah', []);

        foreach ($bahanbaku as $bb => $value) {
            $ingredients[] = [
                "menu_id" => $request->menu_id,
                "bahanbaku_id" => $bahanbaku[$bb],
                "jumlah" => $jumlah[$bb],
                "porsi" => $request->porsi,
                "keterangan" => $request->keterangan,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        Ingredients::insert($ingredients);
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('ingredients.index');
    }

    public function edit($id)
    {
        $ingredients = ingredients::findOrFail($id);
        return view("dapur.ingredients.edit", compact('ingredients'));
    }


    public function update(Request $request, $id)
    {
        $ingredients = Ingredients::findOrFail($id);
        $ingredients->nama = $request->nama;
        $ingredients->status = $request->status;
        $ingredients->save();
        Alert::success('Terupdate', 'Data Berhasil Diupdate');
        return redirect()->route('ingredients.index');
    }


    public function delete($id)
    {
        $ingredients = Ingredients::findOrFail($id);
        $ingredients->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('kategori.index');
    }
}
