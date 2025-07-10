<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Pemasok;
use App\Models\Pembeli;
use App\Models\PenjualanByProduk;
use App\Models\PenjualanByRiwayat;
use App\Models\Pilihan;
use App\Models\Produk;
use App\Models\ProdukByFoto;
use App\Models\ProdukBySatuan;
use App\Models\Provinsi;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanPenjualanController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Laporan Penjualan';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->orderBy('id', 'desc')->get();

        return view("admin.laporan_penjualan.index", compact('title', 'data'));
    }

    public function get_satuan($produk_id)
    {
        $satuan = ProdukBySatuan::with('satuan')->where('produk_id', $produk_id)->get();

        return response()->json($satuan);
    }


    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $title = $this->title;
        $option_pembeli = Pembeli::all();
        $option_produk  = Produk::all();
        $option_satuan  = Satuan::all();
        $option_tipe_pengiriman  = Pilihan::where('nama', 'tipe_pengiriman')->get();

        $produks = PenjualanByProduk::with('satuan', 'produk')->where('penjualan_id', $penjualan->id)->get();

        return view("admin.penjualan.show", compact('title', 'penjualan', 'option_pembeli', 'option_produk', 'option_satuan', 'produks', 'option_tipe_pengiriman'));
    }
}
