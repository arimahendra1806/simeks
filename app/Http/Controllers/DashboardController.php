<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Models\Pembeli;
use App\Models\Penjualan;
use App\Models\PenjualanByProduk;
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
            $arrDataJumlah[] = Penjualan::whereMonth('tanggal_pembelian', $key + 1)->whereYear('tanggal_pembelian', date('Y'))->count();
            $arrDataNominal[] = Penjualan::whereMonth('tanggal_pembelian', $key + 1)->whereYear('tanggal_pembelian', date('Y'))->sum('total_pembelian');
        }
        $dataJumlah = $arrDataJumlah;
        $dataNominal = $arrDataNominal;

        $produk = Produk::with('pemasok')->orderBy('id', 'desc')->get();
        $penjualan = Penjualan::with('pembeli', 'statusPenjualan')->orderBy('id', 'desc')->get();
        $pembelian = Penjualan::selectRaw('pembeli_id, COUNT(*) as total')
            ->with('pembeli')
            ->where('status', '<>', 99)
            ->groupBy('pembeli_id')
            ->having('total', '>', 0)
            ->orderByDesc('total')
            ->get();

        $arrProduk = [];
        $arrTotalTerjual = [];

        $produkTerlaris = Produk::with('penjualanByProduk')
            ->leftJoin('penjualan_by_produks', 'produks.id', '=', 'penjualan_by_produks.produk_id')
            ->leftJoin('penjualans', function ($join) {
                $join->on('penjualan_by_produks.penjualan_id', '=', 'penjualans.id')
                    ->where('penjualans.status', '!=', 99);
            })
            ->select('produks.id', 'produks.nama')
            ->selectRaw('COALESCE(SUM(penjualan_by_produks.kuantitas), 0) as total_terjual')
            ->groupBy('produks.id', 'produks.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        foreach ($produkTerlaris as $item) {
            $arrProduk[] = $item->nama ?? 'Produk tidak ditemukan';
            $arrTotalTerjual[] = (int) $item->total_terjual;
        }

        $dataLabelProduk = $arrProduk;
        $dataJumlahProduk = $arrTotalTerjual;

        return view('admin.dashboard.index', compact('title', 'total_produk', 'total_pemasok', 'total_pembeli', 'total_transaksi', 'labelJumlah', 'dataJumlah', 'dataNominal', 'produk', 'penjualan', 'pembelian', 'dataLabelProduk', 'dataJumlahProduk'));
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
