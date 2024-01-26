<?php

use App\Http\Controllers\{BahanBakuController, BahanBakuKeluarController, BahanBakuMasukController, BillOfMaterialController, CustomerController, DashboardController, HomeController, IngredientsController, KategoriController, LaporanController, MejaController, MenuController, OrderController, PembayaranController, UserController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/order-user', [OrderController::class, "order_user"])->name('order.user');
Route::get('/order-user-berhasil/{id}', [OrderController::class, "order_user_sukses"])->name('order.sukses');

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::resource('/dashboard', DashboardController::class);
    Route::get('/penjualan-by-bulan-tahun', [DashboardController::class, 'penjualanBulanan'])->name('penjualan.bulan');
    Route::get('/penjualan-by-tahun', [DashboardController::class, 'penjualanTahunan'])->name('penjualan.tahun');
    // eoq
    Route::get('/hitung/eoq', [DashboardController::class, 'hitungEoq'])->name('hitung_eoq');
    Route::post('/hitung/eoq', [DashboardController::class, 'hitungEoqStore'])->name('hitung.store');

    Route::resource('/bahan-baku', BahanBakuController::class);
    Route::get('/bahan-baku/hapus/{id}', [BahanBakuController::class, "delete"]);


    Route::resource('/bahanbaku-terpakai', BahanBakuKeluarController::class);
    Route::get('/bahanbaku-terpakai/hapus/{id}', [BahanBakuKeluarController::class, "delete"]);

    Route::resource('/bahanbaku-masuk', BahanBakuMasukController::class);
    Route::get('/bahanbaku-masuk/hapus/{id}', [BahanBakuMasukController::class, "delete"]);

    // user
    Route::resource('/user', UserController::class);
    Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

    // meja
    Route::resource('/meja', MejaController::class);
    Route::get('/meja/hapus/{id}', [MejaController::class, "delete"]);
    // kategori
    Route::resource('/kategori', KategoriController::class);
    Route::get('/kategori/hapus/{id}', [KategoriController::class, "delete"]);
    // menu
    Route::resource('/menu', MenuController::class);
    Route::get('/menu/hapus/{id}', [MenuController::class, "delete"]);
    // order
    Route::resource('/order', OrderController::class);
    Route::get('/order/hapus/{id}', [OrderController::class, "delete"]);
    Route::get('/riwayat-order', [OrderController::class, "riwayat"])->name('order.riwayat');
    // pembayaran
    Route::resource('/pembayaran', PembayaranController::class);
    Route::get('/pembayaran/hapus/{id}', [PembayaranController::class, "delete"]);
    Route::get('/pembayaran/order/{id}', [PembayaranController::class, "order"])->name('pembayaran.order');
    Route::get('/pembayaran/sukses/{id}', [PembayaranController::class, "sukses"])->name('pembayaran.sukses');
    Route::get('/pembayaran/cetak/{id}', [PembayaranController::class, "cetak_struk"])->name('pembayaran.cetak');

    // ingredients
    Route::resource('/ingredients', IngredientsController::class);
    Route::get('/ingredients/hapus/{id}', [IngredientsController::class, 'delete']);
});



// //customer
// Route::resource('/customer', CustomerController::class);
// Route::get('/customer/hapus/{id}', [CustomerController::class, "delete"]);

// laporan
// laporan penjualan
// Route::get('/laporan-penjualan', [LaporanController::class, 'view_penjualan'])->name('laporan.penjualan');
// Route::post('/laporan-penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan.print');

// // laporan pembelian
// Route::get('/laporan-pembelian', [LaporanController::class, 'view_pembelian'])->name('laporan.pembelian');
// Route::post('/laporan-pembelian', [LaporanController::class, 'pembelian'])->name('laporan.pembelian.print');

// // laporan bahan  baku
// Route::get('/laporan-bahanbaku', [LaporanController::class, 'view_bahanbaku'])->name('laporan.bahanbaku');
// Route::post('/laporan-bahanbaku', [LaporanController::class, 'bahan_baku'])->name('laporan.bahanbaku.print');

// // laporan Hutang
// Route::get('/laporan-hutang', [LaporanController::class, 'view_hutang'])->name('laporan.hutang');
// Route::post('/laporan-hutang', [LaporanController::class, 'hutang'])->name('laporan.hutang.print');

// // laporan Piutang
// Route::get('/laporan-piutang', [LaporanController::class, 'view_piutang'])->name('laporan.piutang');
// Route::post('/laporan-piutang', [LaporanController::class, 'piutang'])->name('laporan.piutang.print');

// // laporan supplier
// Route::get('/laporan-supplier', [LaporanController::class, 'view_supplier'])->name('laporan.supplier');
// Route::post('/laporan-supplier', [LaporanController::class, 'supplier'])->name('laporan.supplier.print');

// // laporan bahan baku keluar
// Route::get('/laporan-bahanbaku-keluar', [LaporanController::class, 'view_bahanbaku_keluar'])->name('laporan.bahanbaku_keluar');
// Route::post('/laporan-bahanbaku-keluar', [LaporanController::class, 'bahan_baku_keluar'])->name('laporan.bahanbaku-keluar.print');

// // laporan bahan baku masuk
// Route::get('/laporan-bahanbaku-masuk', [LaporanController::class, 'view_bahanbaku_masuk'])->name('laporan.bahanbaku_masuk');
// Route::post('/laporan-bahanbaku-masuk', [LaporanController::class, 'bahan_baku_masuk'])->name('laporan.bahanbaku-masuk.print');

// // laporan finish good
// Route::get('/laporan-finishgood', [LaporanController::class, 'view_finishgood'])->name('laporan.finishgood');
// Route::post('/laporan-finishgood', [LaporanController::class, 'finish_good'])->name('laporan.finishgood.print');

// // laporan jadwal produksi
// Route::get('/laporan-jadwalproduksi', [LaporanController::class, 'view_jadwalproduksi'])->name('laporan.jadwalproduksi');
// Route::post('/laporan-jadwalproduksi', [LaporanController::class, 'jadwal_produksi'])->name('laporan.jadwalproduksi.print');

// // laporan pencatatan produksi
// Route::get('/laporan-pencatatanproduksi', [LaporanController::class, 'view_pencatatanproduksi'])->name('laporan.pencatatanproduksi');
// Route::post('/laporan-pencatatanproduksi', [LaporanController::class, 'pencatatan_produksi'])->name('laporan.pencatatanproduksi.print');

// // laporan permintaan bahan baku
// Route::get('/laporan-permintaanbahanbaku', [LaporanController::class, 'view_permintaanbahanbaku'])->name('laporan.permintaanbahanbaku');
// Route::post('/laporan-permintaanbahanbaku', [LaporanController::class, 'permintaan_bahan_baku'])->name('laporan.permintaanbahanbaku.print');

// // laporan stok
// Route::get('/laporan-stok', [LaporanController::class, 'view_stok'])->name('laporan.stok');
// Route::post('/laporan-stok', [LaporanController::class, 'stok'])->name('laporan.stok.print');
// Route::get('/laporan-stokfinishgood', [LaporanController::class, 'view_stokfinishgood'])->name('laporan.stokfinishgood');
// Route::post('/laporan-stokfinishgood', [LaporanController::class, 'stokfinishgood'])->name('laporan.stokfinishgood.print');