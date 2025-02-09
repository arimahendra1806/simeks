<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanByDokumenController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
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

// Route::get('/', [LandingController::class, 'index']);
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard.index');
            case 2:
                return redirect()->route('marketing.dashboard.index');
            case 3:
                return redirect()->route('direktur.dashboard.index');
            case 4:
                return redirect()->route('buyer.dashboard.index');
        }
    }
    return redirect()->route('admin_login');
});

Route::get('/home', function () {
    if (Auth::check()) {
        $user = Auth::user();
        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard.index');
            case 2:
                return redirect()->route('marketing.dashboard.index');
            case 3:
                return redirect()->route('direktur.dashboard.index');
            case 4:
                return redirect()->route('buyer.dashboard.index');
        }
    }
    return redirect()->route('admin_login');
});

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'admin_login'])->name('admin_login');
    Route::post('admin/do_log', [LoginController::class, 'do_log_admin'])->name('do_log_admin');
    Route::get('marketing/login', [LoginController::class, 'marketing_login'])->name('marketing_login');
    Route::post('marketing/do_log', [LoginController::class, 'do_log_marketing'])->name('do_log_marketing');
    Route::get('direktur/login', [LoginController::class, 'direktur_login'])->name('direktur_login');
    Route::post('direktur/do_log', [LoginController::class, 'do_log_direktur'])->name('do_log_direktur');
    Route::get('buyer/login', [LoginController::class, 'buyer_login'])->name('buyer_login');
    Route::post('buyer/do_log', [LoginController::class, 'do_log_buyer'])->name('do_log_buyer');
});

Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_admin'])->name('index');
    });
    Route::resource('/bank', BankController::class);
    Route::resource('/dokumen', DokumenController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/kota', KotaController::class);
    Route::resource('/negara', NegaraController::class);
    Route::get('/produk/import', [ProdukController::class, 'import'])->name('produk.import');
    Route::post('/produk/import_data', [ProdukController::class, 'import_data'])->name('produk.importData');
    Route::get('produk/kota/{provinsi}', [ProdukController::class, 'get_kota'])->name('produk.getKota');
    Route::resource('/produk', ProdukController::class);
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
    Route::resource('/penjualan/pengiriman', PenjualanByPengiriman::class);
    Route::resource('/penjualan/pengembalian', PenjualanByPengembalian::class);
});

Route::middleware('marketing')->name('marketing.')->prefix('marketing')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_marketing'])->name('index');
    });

    Route::resource('/produk', ProdukController::class);
    Route::resource('/pembeli', PembeliController::class);
    Route::resource('/pasar', PasarController::class);
    Route::resource('/penjualan', PenjualanController::class);
});

Route::middleware('direktur')->name('direktur.')->prefix('direktur')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_direktur'])->name('index');
    });

    Route::resource('/pembeli', PembeliController::class);
    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/pasar', PasarController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/penjualan', PenjualanController::class);
    Route::resource('/penjualan/pengiriman', PenjualanByPengiriman::class);
    Route::resource('/penjualan/pengembalian', PenjualanByPengembalian::class);
    Route::resource('/penjualan/dokumen', PenjualanByDokumenController::class);
});

Route::middleware('buyer')->name('buyer.')->prefix('buyer')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard_buyer'])->name('index');
    });
    Route::resource('/pembayaran', PenjualanByBayar::class);
});
