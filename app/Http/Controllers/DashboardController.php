<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Hutang;
use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        // $penjualan_total = Penjualan::select('total')->sum('total');
        // $pembelian_total = Pembelian::select('total')->sum('total');
        // $hutang = Hutang::select('total')->sum('total');
        // $piutang = Piutang::select('total')->sum('total');
        $menu = Menu::count();
        $pendapatan_hari_ini = Pembayaran::whereDate('waktu_bayar', today())->sum('total');
        $pendapatan_bulan_ini = Pembayaran::whereMonth('waktu_bayar', now()->month)->sum('total');
        $pendapatan_tahun_ini = Pembayaran::whereYear('waktu_bayar', now()->year)->sum('total');


        // $produk_terlaris = DB::table('penjualan_details')
        //     ->join('finish_goods', 'penjualan_details.finishgood_id', '=', 'finish_goods.id')
        //     ->select(
        //         'finish_goods.nama_fg',
        //         DB::raw('YEAR(penjualan_details.tanggal_penjualan) as tahun'),
        //         DB::raw('MONTH(penjualan_details.tanggal_penjualan) as bulan'),
        //         DB::raw('SUM(penjualan_details.jumlah) as jumlah_penjualan')
        //     )
        //     // ->whereYear('penjualan_details.tanggal_penjualan', Carbon::now()->year)
        //     // ->whereMonth('penjualan_details.tanggal_penjualan', Carbon::now()->month)
        //     ->groupBy('finish_goods.id', 'finish_goods.nama_fg', 'tahun', 'bulan')
        //     ->orderBy('tahun', 'desc')
        //     ->orderBy('bulan', 'desc')
        //     ->orderBy('jumlah_penjualan', 'desc')
        //     ->take(5)
        //     ->get();

        // ddd($produk_terlaris);
        $penjualan_tahunan = OrderDetail::select(DB::raw('YEAR(created_at) as year'), 'menu_id', DB::raw('SUM(jumlah) as total'))->with('menu')
            ->whereYear('created_at', now()->year)
            ->orderBy('total', 'desc')
            ->groupBy('year', 'menu_id')
            ->get();

        $penjualan_bulanan = OrderDetail::select(DB::raw('MONTH(created_at) as month'), 'menu_id', DB::raw('SUM(jumlah) as total'))->with('menu')
            ->orderBy('total', 'desc')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('month', 'menu_id')
            ->get()->map(
                function ($item) {
                    $item->month_name = date('F', mktime(0, 0, 0, $item->month, 1)); // Mengubah angka bulan menjadi nama bulan
                    return $item;
                }
            );

        return view('dashboard', compact('penjualan_tahunan', 'penjualan_bulanan', 'pendapatan_hari_ini', 'pendapatan_bulan_ini', 'pendapatan_tahun_ini'));
    }
    public function penjualanBulanan(Request $request)
    {
        if ($request->ajax()) {

            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');

            $penjualan_bulanan = OrderDetail::select(DB::raw('MONTH(created_at) as month'), 'menu_id', DB::raw('SUM(jumlah) as total'))
                ->with('menu')
                ->when($bulan, function ($query) use ($bulan) {
                    return $query->whereMonth('created_at', $bulan);
                })
                ->when($tahun, function ($query) use ($tahun) {
                    return $query->whereYear('created_at', $tahun);
                })
                ->orderBy('total', 'desc')
                ->groupBy('month', 'menu_id')
                ->get()
                ->map(function ($item) {
                    $item->month_name = date('F', mktime(0, 0, 0, $item->month, 1));
                    return $item;
                });
            return response()->json($penjualan_bulanan);
        }
    }
    public function penjualanTahunan(Request $request)
    {
        if ($request->ajax()) {

            $tahun = $request->input('tahun');

            $penjualan_tahunan = OrderDetail::select(DB::raw('YEAR(created_at) as year'), 'menu_id', DB::raw('SUM(jumlah) as total'))
                ->with('menu')
                ->when($tahun, function ($query) use ($tahun) {
                    return $query->whereYear('created_at', $tahun);
                })
                ->orderBy('total', 'desc')
                ->groupBy('year', 'menu_id')
                ->get();

            return response()->json($penjualan_tahunan);
        }
    }
    public function getByBulanTahun(Request $request)
    {
        if ($request->ajax()) {
            $produk_terlaris = DB::table('penjualan_details')
                ->join('finish_goods', 'penjualan_details.finishgood_id', '=', 'finish_goods.id')
                ->select(
                    'finish_goods.nama_fg',
                    DB::raw('YEAR(penjualan_details.tanggal_penjualan) as tahun'),
                    DB::raw('MONTH(penjualan_details.tanggal_penjualan) as bulan'),
                    DB::raw('SUM(penjualan_details.jumlah) as jumlah_penjualan')
                )
                ->whereYear('penjualan_details.tanggal_penjualan', $request->tahun)
                ->whereMonth('penjualan_details.tanggal_penjualan', $request->bulan)
                ->groupBy('finish_goods.id', 'finish_goods.nama_fg', 'tahun', 'bulan')
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->orderBy('jumlah_penjualan', 'desc')
                ->take(5)
                ->get();

            return response()->json($produk_terlaris);
        }
    }
    //eoq
    public function calculateEOQ($demand, $orderCost, $holdingCost)
    {
        // Rumus EOQ: sqrt((2 * demand * orderCost) / holdingCost)
        $biayaPerpesan = 0.1;
        return sqrt((2 * $demand * $orderCost) / ($holdingCost * $biayaPerpesan));
    }

    public function hitungEoq()
    {
        $bahanbaku = BahanBaku::get();
        return view('admin.hitung-eoq.index', compact('bahanbaku'));
    }
    public function hitungEoqStore(Request $request)
    {
        $demand = $request->demand;
        $orderCost = $request->order_cost;
        $holdingCost = $request->holding_cost;
        $bahanbaku_id = $request->bb_id;

        $bahan_baku = BahanBaku::findOrFail($bahanbaku_id);
        $hasil_eoq = ceil($this->calculateEOQ($demand, $orderCost, $holdingCost));

        // jumlah setiap memesan bahan baku
        $jumlah_per_pesan = ceil($demand / $hasil_eoq);
        // periode pemesan berapa hari sekali dalam setahun
        $waktu_memesan = ceil(360 / $jumlah_per_pesan);
        $bahanbaku = BahanBaku::get();

        $data = [
            "demand" => $demand,
            "orderCost" => $orderCost,
            "holdingCost" => $holdingCost,
            "bahanbaku" => $bahanbaku,
            "bahan_baku" => $bahan_baku,
            "hasil_eoq" => $hasil_eoq,
            "jumlah_per_pesan" => $jumlah_per_pesan,
            "waktu_memesan" => $waktu_memesan
        ];

        // ddd($data);
        Alert::success('Berhasil', 'Perhitungan EOQ Berhasil Dihitung.');
        return view('admin.hitung-eoq.index', $data);
    }
}
