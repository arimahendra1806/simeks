<?php

namespace App\Http\Controllers;

use App\Models\PenjualanByBayar;
use App\Models\Penjualan;
use App\Models\Pilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanByBayarController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Pembayaran';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->where('status', '>', 2)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_bayar.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function validation(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $title = $this->title;

        $option_tipe_pengiriman  = Pilihan::where('nama', 'tipe_pengiriman')->get();

        // UPDATE CANCEL PEMBAYARAN SEBELUMNYA
        PenjualanByBayar::where('penjualan_id', $id)
            ->where('transaction_midtrans_status', null)
            ->whereDate('created_at', '<', date('Y-m-d'))
            ->update([
                'transaction_midtrans_status' => 'expire',
            ]);

        $penjualan = Penjualan::with('pembeli')->where('id', $id)->first();
        $bayar = PenjualanByBayar::with('statusKategori')->where('penjualan_id', $id)->orderBy('id', 'asc')->get();

        return view("admin.penjualan_bayar.show", compact('title', 'penjualan', 'bayar', 'option_tipe_pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjualanByBayar $PenjualanByBayar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function generate_tagihan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nominal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Nominal harus diisi!');
        }

        $id_penjualan = $request->id_penjualan;
        $nominal = remove_currency($request->nominal);

        $data_penjualan = Penjualan::where('id', $id_penjualan)->first();
        $sisa_pembayaran = $data_penjualan->sisa_pembayaran;

        if ((int) $nominal == 0) {
            return redirect()->back()
                ->withErrors(['nominal' => 'Tidak boleh 0'])
                ->with('error', 'Nominal harus diisi!');
        }

        if ((int) $nominal > (int) $sisa_pembayaran) {
            return redirect()->back()
                ->withErrors(['nominal' => 'Nominal tidak boleh melebihi sisa pembayaran.'])
                ->with('error', 'Nominal tidak boleh melebihi sisa pembayaran.');
        }

        DB::beginTransaction();
        try {
            // UPDATE CANCEL PEMBAYARAN SEBELUMNYA
            PenjualanByBayar::where('penjualan_id', $id_penjualan)
                ->where('transaction_midtrans_status', null)
                ->update([
                    'transaction_midtrans_status' => 'expire',
                ]);

            // CEK KATEGORI PEMBAYARAN
            $kategori_pembayaran = 1;
            $cek_kategori_pembayaran = PenjualanByBayar::where('penjualan_id', $id_penjualan)->where('transaction_midtrans_status', 'settlement')->first();
            if ($cek_kategori_pembayaran) {
                if ($nominal == $sisa_pembayaran) {
                    $kategori_pembayaran = 3;
                } else {
                    $kategori_pembayaran = 2;
                }
            }

            PenjualanByBayar::create([
                'kode_bayar' => generate_code("PAY", (PenjualanByBayar::orderBy('id', 'desc')->first()->kode_bayar ?? '')),
                'penjualan_id' => $id_penjualan,
                'kategori_pembayaran' => $kategori_pembayaran,
                'nominal' => $nominal,
            ]);

            DB::commit();
            return back()->with('success', 'Tagihan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
