<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Pemasok;
use App\Models\Pembeli;
use App\Models\PenjualanByProduk;
use App\Models\PenjualanByRiwayat;
use App\Models\Produk;
use App\Models\ProdukByFoto;
use App\Models\ProdukBySatuan;
use App\Models\Provinsi;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Penjualan';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->orderBy('id', 'desc')->get();

        return view("admin.penjualan.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_pembeli = Pembeli::all();
        $option_produk  = Produk::all();
        $option_satuan  = Satuan::all();

        return view("admin.penjualan.create", compact('title', 'option_pembeli', 'option_produk', 'option_satuan'));
    }

    public function get_satuan($produk_id)
    {
        $satuan = ProdukBySatuan::with('satuan')->where('produk_id', $produk_id)->get();

        return response()->json($satuan);
    }

    private function validation(Request $request)
    {
        $request->validate([
            'pembeli_id' => 'required',
            'tanggal_negosiasi' => 'required|string|max:255',
            'tanggal_pembelian' => 'required',
            'hasil_negosiasi' => 'required',
            'permintaan' => 'required',
            'produk_id' => 'required|array',
            'satuan_id' => 'required|array',
            'kuantitas' => 'required|array',
            'kuantitas.*' => 'numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'numeric|min:0',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        DB::beginTransaction();
        try {
            $penjualan = Penjualan::create([
                'kode_transaksi' => generate_code("TRX", (Penjualan::orderBy('id', 'desc')->first()->kode_transaksi ?? '')),
                'pembeli_id' => $request->pembeli_id,
                'tanggal_negosiasi' => indo_to_date($request->tanggal_negosiasi),
                'tanggal_pembelian' => indo_to_date($request->tanggal_pembelian),
                'hasil_negosiasi' => $request->hasil_negosiasi,
                'permintaan' => $request->permintaan,
            ]);

            $total_all = 0;
            foreach ($request->satuan_id as $index => $satuan_id) {
                $data_satuan = ProdukBySatuan::where('produk_id', $request->produk_id[$index])->where('satuan_id', $satuan_id)->first();
                $total = (int) remove_currency($request->harga[$index]) * (int) remove_currency($request->kuantitas[$index]);

                PenjualanByProduk::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $request->produk_id[$index],
                    'satuan_id' => $satuan_id,
                    'qty' => $data_satuan->kuantitas,
                    'kuantitas' => $request->kuantitas[$index],
                    'harga' => $request->harga[$index],
                    'diskon_nominal' => 0,
                    'diskon_persen' => 0,
                    'total' => $total,
                ]);

                $total_all += $total;
            }

            Penjualan::where('id', $penjualan->id)->update([
                'total_pembelian' => $total_all,
                'ppn' => 0,
                'pph' => 0,
                'diskon_nominal' => 0,
                'diskon_persen' => 0,
                'biaya_pengiriman' => 0,
                'total_pembayaran' => $total_all,
                'total_terbayar' => 0,
                'sisa_pembayaran' => $total_all,
                'status' => 1,
            ]);

            PenjualanByRiwayat::create([
                'references_id' => $penjualan->id,
                'penjualan_id' => 0,
                'tipe' => 1,
                'status' => 1,
                'tanggal' => date('Y-m-d'),
            ]);

            DB::commit();
            return redirect()->route("$this->prefix.penjualan.index")->with('success', 'Penjualan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

        $produks = PenjualanByProduk::with('satuan', 'produk')->where('penjualan_id', $penjualan->id)->get();

        return view("admin.penjualan.show", compact('title', 'penjualan', 'option_pembeli', 'option_produk', 'option_satuan', 'produks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $this->validation($request, $penjualan->id);

        DB::beginTransaction();
        try {
            $penjualan->update([
                'pembeli_id' => $request->pembeli_id,
                'tanggal_negosiasi' => indo_to_date($request->tanggal_negosiasi),
                'tanggal_pembelian' => indo_to_date($request->tanggal_pembelian),
                'hasil_negosiasi' => $request->hasil_negosiasi,
                'permintaan' => $request->permintaan,
            ]);

            $total_all = 0;
            $penjualan->penjualanByProduk()->delete();
            foreach ($request->satuan_id as $index => $satuan_id) {
                $data_satuan = ProdukBySatuan::where('produk_id', $request->produk_id[$index])->where('satuan_id', $satuan_id)->first();
                $total = (int) remove_currency($request->harga[$index]) * (int) remove_currency($request->kuantitas[$index]);

                PenjualanByProduk::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $request->produk_id[$index],
                    'satuan_id' => $satuan_id,
                    'qty' => $data_satuan->kuantitas,
                    'kuantitas' => $request->kuantitas[$index],
                    'harga' => $request->harga[$index],
                    'diskon_nominal' => 0,
                    'diskon_persen' => 0,
                    'total' => $total,
                ]);

                $total_all += $total;
            }

            $penjualan->update([
                'total_pembelian' => $total_all,
                'ppn' => 0,
                'pph' => 0,
                'diskon_nominal' => 0,
                'diskon_persen' => 0,
                'biaya_pengiriman' => 0,
                'total_pembayaran' => $total_all,
                'total_terbayar' => 0,
                'sisa_pembayaran' => $total_all,
            ]);

            DB::commit();
            return redirect()->route("$this->prefix.penjualan.index")->with('success', 'Penjualan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->penjualanByProduk()->delete();
        $penjualan->delete();

        return redirect()->route("$this->prefix.penjualan.index")->with('success', 'Data berhasil diihapus!');
    }

    public function konfirmasi(Penjualan $penjualan)
    {
        DB::beginTransaction();
        try {
            $penjualan->update([
                'status' => 2,
            ]);

            PenjualanByRiwayat::create([
                'references_id' => $penjualan->id,
                'penjualan_id' => 0,
                'tipe' => 1,
                'status' => 2,
                'tanggal' => date('Y-m-d'),
            ]);

            DB::commit();
            return redirect()->route("$this->prefix.penjualan.index")->with('success', 'Penjualan berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
