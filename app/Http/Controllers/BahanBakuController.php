<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:Admin|Direktur|Gudang');
    // }
    public function index()
    {
        $bahanbaku = BahanBaku::get();
        return view('dapur.bahanbaku.index', compact("bahanbaku"));
    }

    // public function pembelian()
    // {
    //     $bahanbaku = BahanBaku::with('supplier')->get();
    //     return view('admin.transaksi.pembelian.index', compact("bahanbaku"));
    // }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $material = new BahanBaku;
        $material->nama = $request->nama;
        $material->stok = $request->stok;
        $material->minimal_stok = $request->minimal_stok;
        $material->status = $request->status;
        $material->harga = $request->harga;
        $material->satuan = $request->satuan;
        $material->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('bahan-baku.index');
    }


    // public function detail($id)
    // {
    //     $bahanbaku = BahanBaku::findOrFail($id);
    //     return view("admin.transaksi.pembelian.detail", compact('bahanbaku'));
    // }


    public function edit($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        return view("dapur.bahanbaku.edit", compact('bahanbaku'));
    }


    public function update(Request $request, $id)
    {
        $material = BahanBaku::findOrFail($id);
        $material->nama = $request->nama;
        $material->stok = $request->stok;
        $material->minimal_stok = $request->minimal_stok;
        $material->status = $request->status;
        $material->harga = $request->harga;
        $material->satuan = $request->satuan;
        $material->save();
        Alert::success('Terupdate', 'Data Berhasil Diupdate');
        return redirect()->route('bahan-baku.index');
    }


    public function delete($id)
    {
        $barang = BahanBaku::findOrFail($id);
        $barang->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('bahan-baku.index');
    }
}
