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
        $bahanbaku = BahanBaku::with('orderbahanbaku')->orderBy('id', 'desc')->get();
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

    public function calculateEOQ($s, $d, $h)
    {
        // EOQ = √(2SD/H)
        // S = Biaya Pemesanan untuk sekali pesan
        // D = Permintaan, jumlah menu terjual dalam setahun / bulan
        // H = Biaya Penyimpanan per unit bahan baku dalam setahun / sebulan
        return sqrt((2 * $s * $d) / $h);
    }

    public function show($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        // biaya penyimpanan dan pemesanan  sekali pesan 10% dari harga dan total harga

        $s = ($bahanbaku->rata_rata_stok_pertahun * $bahanbaku->harga) * 0.1;
        $d = $bahanbaku->rata_rata_stok_pertahun;
        $h = $bahanbaku->harga * 0.1;

        $eoq = (int) round($this->calculateEOQ($s, $d, $h));
        // rumus :
        // Reorder point = penggunaan selama lead
        // time + safety stock / minimal stock
        $pemakaian_perhari = $eoq / 365;
        $rop = round(($pemakaian_perhari * $bahanbaku->lead_time) + $bahanbaku->minimal_stok);
        return view("dapur.bahanbaku.show", compact('bahanbaku', 'eoq', 'rop', 'h', 's'));
    }
    public function store(Request $request)
    {

        $material = new BahanBaku;
        $material->nama = $request->nama;
        $material->stok = $request->stok;
        $material->lead_time = $request->lead_time;
        $material->rata_rata_stok_pertahun = $request->rata_rata_stok_pertahun;
        $material->minimal_stok = $request->minimal_stok;
        $material->maximal_stok = $request->maximal_stok;
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
        $material->lead_time = $request->lead_time;
        $material->rata_rata_stok_pertahun = $request->rata_rata_stok_pertahun;
        $material->maximal_stok = $request->maximal_stok;
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