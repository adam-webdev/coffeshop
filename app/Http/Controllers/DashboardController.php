<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\OrderDetail;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // $penjualan_total = Penjualan::select('total')->sum('total');
        // $pembelian_total = Pembelian::select('total')->sum('total');
        // $hutang = Hutang::select('total')->sum('total');
        // $piutang = Piutang::select('total')->sum('total');



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
            ->orderBy('total', 'desc')
            ->groupBy('year', 'menu_id')
            ->get();
        $penjualan_bulanan = OrderDetail::select(DB::raw('MONTH(created_at) as month'), 'menu_id', DB::raw('SUM(jumlah) as total'))->with('menu')
            ->orderBy('total', 'desc')
            ->groupBy('month', 'menu_id')
            ->get()->map(
                function ($item) {
                    $item->month_name = date('F', mktime(0, 0, 0, $item->month, 1)); // Mengubah angka bulan menjadi nama bulan
                    return $item;
                }
            );

        return view('dashboard', compact('penjualan_tahunan', 'penjualan_bulanan'));
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
}
