<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanByBayarController;
use App\Http\Controllers\PenjualanByDokumenController;
use App\Http\Controllers\PenjualanByPengirimanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanByBayarSupplierController;
use App\Models\PenjualanByBayar;
use App\Models\PenjualanByPengembalian;
use App\Models\PenjualanByPengiriman;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);
Route::get('/invoice_pay/{params}', [LandingController::class, 'invoice_pay'])->name('invoice_pay');
Route::get('/invoice_pay_success/{params}', [LandingController::class, 'invoice_pay_success'])->name('invoice_pay_success');
Route::post('/invoice_pay/now', [LandingController::class, 'invoice_pay_now'])->name('invoice_pay_now');
Route::post('/update_status_invoice_pay', [LandingController::class, 'update_status_invoice_pay'])->name('update_status_invoice_pay');
Route::get('/status_shipment/{params}', [LandingController::class, 'status_shipment'])->name('status_shipment');
Route::post('/status_shipment_update', [LandingController::class, 'status_shipment_update'])->name('status_shipment_update');
Route::post('/pengiriman_darurat', [LandingController::class, 'pengiriman_darurat'])->name('pengiriman_darurat');
Route::post('/pengiriman_lokasi', [LandingController::class, 'pengiriman_lokasi'])->name('pengiriman_lokasi');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard.index');
    }

    return redirect()->route('admin_login');
});

Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard.index');
    }

    return redirect()->route('admin_login');
});

Route::get('/marketing', function () {
    if (Auth::check()) {
        return redirect()->route('marketing.dashboard.index');
    }

    return redirect()->route('marketing_login');
});

Route::get('/direktur', function () {
    if (Auth::check()) {
        return redirect()->route('direktur.dashboard.index');
    }

    return redirect()->route('direktur_login');
});

Route::get('/supplier', function () {
    if (Auth::check()) {
        return redirect()->route('supplier.dashboard.index');
    }

    return redirect()->route('supplier_login');
});

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'admin_login'])->name('admin_login');
    Route::post('admin/do_log', [LoginController::class, 'do_log_admin'])->name('do_log_admin');
    Route::get('marketing/login', [LoginController::class, 'marketing_login'])->name('marketing_login');
    Route::post('marketing/do_log', [LoginController::class, 'do_log_marketing'])->name('do_log_marketing');
    Route::get('direktur/login', [LoginController::class, 'direktur_login'])->name('direktur_login');
    Route::post('direktur/do_log', [LoginController::class, 'do_log_direktur'])->name('do_log_direktur');
    Route::get('supplier/login', [LoginController::class, 'supplier_login'])->name('supplier_login');
    Route::post('supplier/do_log', [LoginController::class, 'do_log_supplier'])->name('do_log_supplier');
    // Route::get('buyer/login', [LoginController::class, 'buyer_login'])->name('buyer_login');
    // Route::post('buyer/do_log', [LoginController::class, 'do_log_buyer'])->name('do_log_buyer');
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });
    Route::resource('/bank', BankController::class);
    Route::resource('/dokumen', DokumenController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/kota', KotaController::class);
    Route::resource('/negara', NegaraController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/industri', IndustriController::class);
    Route::resource('/provinsi', ProvinsiController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/pilihan', PilihanController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/user', UserController::class);

    Route::resource('/pembeli', PembeliController::class);
    Route::get('/pemasok/import', [PemasokController::class, 'import'])->name('pemasok.import');
    Route::post('/pemasok/import_data', [PemasokController::class, 'import_data'])->name('pemasok.importData');
    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/pasar', PasarController::class);
    Route::post('/pengiriman/generate_kirim', [PenjualanByPengirimanController::class, 'generate_kirim'])->name('pengiriman.generate_kirim');
    Route::delete('/pengiriman/destroy/{id}', [PenjualanByPengirimanController::class, 'destroy'])->name('pengiriman.destroy');
    Route::put('/pengiriman/confirm_wa/{id}', [PenjualanByPengirimanController::class, 'confirm_wa'])->name('pengiriman.confirm_wa');
    Route::resource('/pengiriman', PenjualanByPengirimanController::class);
    // Route::resource('/penjualan/pengembalian', PenjualanByPengembalian::class);
});

Route::middleware(['auth', 'marketing'])->name('marketing.')->prefix('marketing')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });

    Route::resource('/produk', ProdukController::class);
    Route::resource('/pembeli', PembeliController::class);
    Route::resource('/pasar', PasarController::class);
    Route::get('/penjualan/satuan/{id}', [PenjualanController::class, 'get_satuan'])->name('penjualan.satuan');
    Route::put('/penjualan/konfirmasi/{penjualan}', [PenjualanController::class, 'konfirmasi'])->name('penjualan.konfirmasi');
    Route::resource('/penjualan', PenjualanController::class);
    Route::put('/dokumen_penjualan/konfirmasi/{id}', [PenjualanByDokumenController::class, 'konfirmasi'])->name('dokumen_penjualan.konfirmasi');
    Route::resource('/penjualan', PenjualanController::class);
});

Route::middleware(['auth', 'direktur'])->name('direktur.')->prefix('direktur')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });

    Route::resource('/pembeli', PembeliController::class);
    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/pasar', PasarController::class);
    Route::resource('/produk', ProdukController::class);
    Route::get('/penjualan/satuan/{id}', [PenjualanController::class, 'get_satuan'])->name('penjualan.satuan');
    Route::put('/penjualan/konfirmasi/{penjualan}', [PenjualanController::class, 'konfirmasi'])->name('penjualan.konfirmasi');
    Route::resource('/penjualan', PenjualanController::class);
    Route::put('/dokumen_penjualan/konfirmasi/{id}', [PenjualanByDokumenController::class, 'konfirmasi'])->name('dokumen_penjualan.konfirmasi');
    Route::put('/dokumen_penjualan/batal/{id}', [PenjualanByDokumenController::class, 'batal'])->name('dokumen_penjualan.batal');
    Route::post('/dokumen_penjualan/tunda', [PenjualanByDokumenController::class, 'tunda'])->name('dokumen_penjualan.tunda');
    Route::resource('/dokumen_penjualan', PenjualanByDokumenController::class);
    Route::post('/pembayaran/generate_tagihan', [PenjualanByBayarController::class, 'generate_tagihan'])->name('pembayaran.generate_tagihan');
    Route::resource('/pembayaran', PenjualanByBayarController::class);
    Route::post('/pengiriman/generate_kirim', [PenjualanByPengirimanController::class, 'generate_kirim'])->name('pengiriman.generate_kirim');
    Route::delete('/pengiriman/destroy/{id}', [PenjualanByPengirimanController::class, 'destroy'])->name('pengiriman.destroy');
    Route::put('/pengiriman/confirm_wa/{id}', [PenjualanByPengirimanController::class, 'confirm_wa'])->name('pengiriman.confirm_wa');
    Route::resource('/pengiriman', PenjualanByPengirimanController::class);
    Route::get('/laporan_penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan.index');
    // Route::resource('/penjualan/pengembalian', PenjualanByPengembalian::class);
    Route::post('/pay_supplier/generate_tagihan', [PenjualanByBayarSupplierController::class, 'generate_tagihan'])->name('pay_supplier.generate_tagihan');
    Route::resource('/pay_supplier', PenjualanByBayarSupplierController::class);
});

// Route::middleware('buyer')->name('buyer.')->prefix('buyer')->group(function () {
//     Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//     Route::prefix('dashboard')->name('dashboard.')->group(function () {
//         Route::get('/', [DashboardController::class, 'dashboard_buyer'])->name('index');
//     });
//     Route::resource('/pembayaran', PenjualanByBayar::class);
// });

Route::middleware('supplier')->name('supplier.')->prefix('supplier')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
        Route::get('/show_supplier/{id}', [DashboardController::class, 'show_supplier'])->name('show_supplier');
        Route::put('/konfirmasi_supplier/{id}', [DashboardController::class, 'konfirmasi_supplier'])->name('konfirmasi_supplier');
    });
});
