<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('id', 'desc')->get();
        $meja = Meja::get();
        $no_order = Order::no_order();
        return view('kasir.order.index', compact('menu', 'no_order', 'meja'));
    }
    public function riwayat()
    {
        $order = Order::with('meja')->orderBy('created_at', 'desc')->get();
        return view('kasir.order.riwayat', compact('order'));
    }

    public function store(Request $request)
    {
        $new_order = new Order();
        $new_order->no_order = $request->no_order;
        $new_order->meja_id = $request->meja_id;
        $new_order->catatan = $request->catatan;
        $new_order->total = $request->total;
        $new_order->waktu = $request->waktu;
        $new_order->status = "unpaid";
        $new_order->save();

        $menu = $request->input('menu_id', []);
        $jumlah = $request->input('jumlah', []);
        $order_id = $new_order->id;
        $hargaMenu = [];

        foreach ($menu as $id_menu) {
            $hargaMenu[] = Menu::select('harga')->where('id', $id_menu)->sum("harga");
        }

        $hargaMenuDikaliQty = [];

        foreach ($hargaMenu as $index => $value) {
            $hargaMenuDikaliQty[$index] = $value * $jumlah[$index];
        }

        foreach ($menu  as $index => $value) {
            $order_detail[] = [
                "menu_id" => $menu[$index],
                "order_id" => $order_id,
                "jumlah" => $jumlah[$index],
                "total" => $hargaMenuDikaliQty[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        DB::table('order_detail')->insert($order_detail);
        Alert::success("Berhasil", "Order berhasil ditambahkan silahkan lakukan pembayaran");
        return redirect()->route('pembayaran.order', [$new_order->id]);
    }
    public function order_user(Request $request)
    {
        $new_order = new Order();
        $new_order->no_order = $request->no_order;
        $new_order->meja_id = $request->meja_id;
        $new_order->catatan = $request->catatan;
        $new_order->total = $request->total;
        $new_order->waktu = $request->waktu;
        $new_order->status = "unpaid";
        $new_order->save();

        $menu = $request->input('menu_id', []);
        $jumlah = $request->input('jumlah', []);
        $order_id = $new_order->id;
        $hargaMenu = [];

        foreach ($menu as $id_menu) {
            $hargaMenu[] = Menu::select('harga')->where('id', $id_menu)->sum("harga");
        }

        $hargaMenuDikaliQty = [];

        foreach ($hargaMenu as $index => $value) {
            $hargaMenuDikaliQty[$index] = $value * $jumlah[$index];
        }

        foreach ($menu  as $index => $value) {
            $order_detail[] = [
                "menu_id" => $menu[$index],
                "order_id" => $order_id,
                "jumlah" => $jumlah[$index],
                "total" => $hargaMenuDikaliQty[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        DB::table('order_detail')->insert($order_detail);
        Alert::success("Berhasil", "Order berhasil silahkan ke kasir untuk melakukan pembayaran");
        return redirect()->route('pembayaran.order', [$new_order->id]);
    }
}
