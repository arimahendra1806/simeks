<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Models\Pembeli;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $title = 'Dashboard Admin';

        $total_produk = Produk::count();
        $total_pemasok = Pemasok::count();
        $total_pembeli = Pembeli::count();
        $total_transaksi = Penjualan::count();

        $labelJumlah = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $arrDataJumlah = [];
        $arrDataNominal = [];
        foreach ($labelJumlah as $key => $value) {
            $arrDataJumlah[] = Penjualan::whereMonth('created_at', $key + 1)->whereYear('created_at', date('Y'))->count();
            $arrDataNominal[] = Penjualan::whereMonth('created_at', $key + 1)->whereYear('created_at', date('Y'))->sum('total_pembelian');
        }
        $dataJumlah = $arrDataJumlah;
        $dataNominal = $arrDataNominal;

        $produk = Produk::with('pemasok')->orderBy('id', 'desc')->get();
        $penjualan = Penjualan::with('pembeli', 'statusPenjualan')->orderBy('id', 'desc')->get();

        return view('admin.dashboard.index', compact('title', 'total_produk', 'total_pemasok', 'total_pembeli', 'total_transaksi', 'labelJumlah', 'dataJumlah', 'dataNominal', 'produk', 'penjualan'));
    }

    public function dashboard_direktur()
    {
        $title = 'Dashboard Direktur';
        return view('direktur.dashboard.index', compact('title'));
    }

    public function dashboard_marketing()
    {
        $title = 'Dashboard Marketing';
        return view('marketing.dashboard.index', compact('title'));
    }
}
