<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('role:Admin|Direktur|Gudang');
    // }

    public function index()
    {
        $bahanbaku = BahanBaku::all();
        $bahanbakuterpakai = BahanBakuKeluar::with('bahanbaku')->orderBy('id', 'desc')->get();
        return view('dapur.bahanbakuterpakai.index', compact("bahanbakuterpakai", "bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $bahanbakuterpakai = new BahanBakuKeluar;
        $bahanbakuterpakai->bahanbaku_id = $request->bahanbaku_id;
        $bahanbakuterpakai->jumlah = $request->jumlah;
        $bahanbakuterpakai->tanggal = $request->tanggal;
        $bahanbaku = BahanBaku::select("stok")->where("id", $request->bahanbaku_id)->first();

        if ($request->jumlah <= $bahanbaku) {
            $bahanbakuterpakai->save();
            Alert::success("Tersimpan", "Data Berhasil Disimpan");
            return redirect()->route('bahanbaku-terpakai.index');
        } else {
            Alert::error("Gagal", "Jumlah barang tidak cukup maksimal {{$bahanbaku}} ");
            return redirect()->route('bahanbaku-terpakai.index');
        }
    }

    public function show($id)
    {
        //
    }

    // public function edit($id)
    // {
    //     $bahanbaku_keluar = BahanBakuKeluar::findOrFail($id);
    //     $bahanbaku = BahanBaku::all();
    //     return view("gudang.bahanbaku_keluar.edit", compact("bahanbaku_keluar", "bahanbaku"));
    // }

    // public function update(Request $request, $id)
    // {
    //     $bahanbaku_keluar = BahanBakuKeluar::findOrFail($id);
    //     $bahanbaku_keluar->bahanbaku_id = $request->bahanbaku_id;
    //     $bahanbaku_keluar->jumlah = $request->jumlah;
    //     $bahanbaku_keluar->save();
    //     Alert::success("Terupdate", "Data Berhasil Diupdate");
    //     return redirect()->route('bahanbaku-keluar.index');
    // }


    public function delete($id)
    {
        $bahanbaku_terpakai = BahanBakuKeluar::findOrFail($id);
        $bahanbaku_terpakai->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('bahanbaku-terpakai.index');
    }
}
