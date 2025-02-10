<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\OrderBahanBaku;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderBahanBakuController extends Controller
{
    public function index($id = null)
    {
        // $id = $_GET['id'];
        $bahanbaku = BahanBaku::select('id', 'nama')->get();
        $orderbahanbaku = OrderBahanBaku::with('bahanbaku')->orderBy('id', 'desc')->get();
        return view('dapur.orderbahanbaku.index', compact("orderbahanbaku", "bahanbaku", 'id'));
    }

    public function store(Request $request)
    {

        $order = new OrderBahanBaku();
        $order->bahanbaku_id = $request->bahanbaku_id;
        $order->jumlah = $request->jumlah;
        $order->petugas = $request->petugas;
        $order->harga = $request->harga;
        $order->total_harga = $request->jumlah * $request->harga;
        $order->keterangan = $request->keterangan;
        $order->supplier = $request->supplier;
        $order->tanggal = $request->tanggal;
        $order->save();
        Alert::success("Berhasil", "Order Bahan baku berhasil disimpan");
        return redirect()->route('orderbahanbaku.index');
    }

    public function show($id)
    {
        $orderbahanbaku = OrderBahanBaku::findOrFail($id);
        return view('dapur.orderbahanbaku.show', compact('orderbahanbaku'));
    }
    public function edit($id)
    {
        $bahanbaku = BahanBaku::select('id', 'nama')->get();

        $orderbahanbaku = OrderBahanBaku::findOrFail($id);
        return view('dapur.orderbahanbaku.edit', compact('orderbahanbaku', 'bahanbaku'));
    }

    public function update(Request $request, $id)
    {
        $order = OrderBahanBaku::findOrFail($id);
        $order->bahanbaku_id = $request->bahanbaku_id;
        $order->jumlah = $request->jumlah;
        $order->petugas = $request->petugas;
        $order->harga = $request->harga;
        $order->total_harga = $request->jumlah * $request->harga;
        $order->keterangan = $request->keterangan;
        $order->supplier = $request->supplier;
        $order->tanggal = $request->tanggal;
        $order->save();
        Alert::success("Berhasil", "Order Bahan baku berhasil diupdate");
        return redirect()->route('orderbahanbaku.index');
    }
    public function delete($id)
    {
        $order = OrderBahanBaku::findOrFail($id);
        $order->delete();
        Alert::success("Berhasil", "Order Bahan baku berhasil dihapus");
        return redirect()->route('orderbahanbaku.index');
    }
}