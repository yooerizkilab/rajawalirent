<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Home
Route::get('/', [WelcomeController::class, 'index']);

// About
Route::get('about', [WelcomeController::class, 'about']);

// Cars
Route::get('cars', [WelcomeController::class, 'cars']); // menampilkan semua mobil
Route::get('cars/show/{id}', [WelcomeController::class, 'viewCars']); // menampilkan detail mobil
Route::get('cars/orders/{id}', [WelcomeController::class, 'orderCars']); // membuat pesanan
Route::post('cars/orders', [WelcomeController::class, 'saveOrder']); // save pesanan
Route::get('cars/orders-detail/{id}', [WelcomeController::class, 'detailOrders'])->name('orders-detail'); // detail pesanan
Route::post('cars/pay', [WelcomeController::class, 'pay']); // melakukan pembayaran
Route::post('cars/pay/notification', [WelcomeController::class, 'paymentNotification']); // mengupdate data pesanan
Route::post('cars/invoice', [WelcomeController::class, 'invoice']); // invoice

// Services
// Route::get('paket', [WelcomeController::class, 'paket']);

// Blog
Route::get('blog', [WelcomeController::class, 'blog']);
Route::get('blog/{id}', [WelcomeController::class, 'viewBlog']);
// Blog Category
Route::get('blog/category/{id}');
// Blog Tag
Route::get('blog/tag/{id}');

// Contact
Route::get('contact', [WelcomeController::class, 'contact']);

// Single Page
Route::get('page', function () {
    return view('pdf.index');
});

// Authentication
Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index']);
});

// Admin Manajement
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    // Dashboard
    Route::get('dashboard', [HomeController::class, 'index']);
    Route::get('grafik', [HomeController::class, 'getGrafikChart']);
    Route::get('pie', [HomeController::class, 'getPieChart']);

    // Produk
    Route::get('produk', [ProdukController::class, 'index']);
    Route::get('produk/create', [ProdukController::class, 'create']);
    Route::post('produk', [ProdukController::class, 'store']);
    Route::get('produk/show/{id}', [ProdukController::class, 'show']);
    Route::get('produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::put('produk/update/{id}', [ProdukController::class, 'update']);
    Route::delete('produk/delete/{id}', [ProdukController::class, 'destroy']);

    // Harga
    Route::get('produk/harga/{id}', [ProdukController::class, 'formHarga']);
    Route::put('produk/harga/{id}', [ProdukController::class, 'tambahHarga']);
    Route::delete('produk/harga/{id}', [ProdukController::class, 'hapusHarga']);

    // Transaksi by admin
    Route::get('transaksi/form-transaksi', [TransaksiController::class, 'formTransaksi']);
    Route::post('transaksi/save-transaksi', [TransaksiController::class, 'saveTransaksi']);

    // Transaksi Data
    Route::get('transaksi/data-transaksi', [TransaksiController::class, 'index']);
    Route::get('transaksi/detail-transaksi/{id}', [TransaksiController::class, 'show']);
    Route::get('transaksi/proses-transaksi/{id}', [TransaksiController::class, 'prosesTransaksi']);
    Route::get('transaksi/edit-transaksi/{id}', [TransaksiController::class, 'editTransaksi']);
    Route::get('transaksi/kembalikan-transaksi/{id}', [TransaksiController::class, 'kembalikanTransaksi']);
    Route::get('transaksi/batalkan-transaksi/{id}', [TransaksiController::class, 'batalkanTransaksi']);
    Route::get('transaksi/print-transaksi/{id}', [TransaksiController::class, 'printTransaksi']);
    Route::delete('transaksi/hapus-transaksi/{id}', [TransaksiController::class, 'hapusTransaksi']);

    // Laporan
    Route::get('report', [ReportController::class, 'index']);
    Route::post('report', [ReportController::class, 'generatePDF']);

    // Pelanggan
    Route::get('pelanggan', [PelangganController::class, 'index']);
    Route::get('pelanggan/show/{id}', [PelangganController::class, 'show']);
    Route::put('pelanggan/reward/{id}', [PelangganController::class, 'update']);

    // About Manajement
    Route::get('about-cms', [CmsController::class, 'cmsAbout']);

    // Blog Manajement
    Route::get('blog-cms', [CmsController::class, 'cmsBlog']);
    Route::get('blog-cms/create', [CmsController::class, 'cmsCreateBlog']);
    Route::post('blog-cm/image', [CmsController::class, 'blogFileCreate']);
    Route::post('blog-cm/image/{id}', [CmsController::class, 'blogFileUpdate']);
    Route::post('blog-cms', [CmsController::class, 'cmsStoreBlog']);
    // Route::get('blog-cms/show/{id}', [CmsController::class, 'cmsShowBlog']);
    Route::get('blog-cms/edit/{id}', [CmsController::class, 'cmsEditBlog']);
    Route::put('blog-cms/update/{id}', [CmsController::class, 'cmsUpdateBlog']);
    Route::delete('blog-cms/delete/{id}', [CmsController::class, 'cmsDestroyBlog']);
});
