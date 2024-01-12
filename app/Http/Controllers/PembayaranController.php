<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayaran.index');
    }

    public function order($id)
    {
        $order = Order::where('id', $id)->first();
        // ddd($order);
        return view('kasir.pembayaran.pembayaran', compact('order'));
    }

    public function store(Request $request)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->status = "cash";
        $pembayaran->order_id = $request->order_id;
        $pembayaran->user_id = $request->user_id;
        $pembayaran->total = $request->total;
        $pembayaran->waktu_bayar = $request->waktu_bayar;
        $pembayaran->uang = $request->uang;
        $pembayaran->kembalian = $request->kembalian;
        $pembayaran->save();
        Order::where('id', $request->order_id)->update(["status" => "paid"]);
        return redirect()->route('pembayaran.sukses', [$pembayaran->id]);
    }

    public function sukses($id)
    {
        return view('kasir.pembayaran.sukses', compact('id'));
    }
}
