<?php

use App\Http\Controllers\{BahanBakuController, BahanBakuKeluarController, BahanBakuMasukController, BillOfMaterialController, CustomerController, DashboardController, HomeController, IngredientsController, KategoriController, LaporanController, MejaController, MenuController, OrderBahanBakuController, OrderController, PembayaranController, UserController};
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

    Route::resource('/orderbahanbaku', OrderBahanBakuController::class);
    Route::get('/orderbahanbaku-now/{id}', [OrderBahanBakuController::class, 'index'])->name('orderbahanbaku.now');
    Route::get('/orderbahanbaku/hapus/{id}', [OrderBahanBakuController::class, "delete"]);

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