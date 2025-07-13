<?php

namespace App\Http\Controllers;

use App\Models\PenjualanByBayar;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanByBayarSupplierController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Pembayaran Supplier';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->where('status', '>', 2)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_bayar_supplier.index", compact('title', 'data'));
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

        $penjualan = Penjualan::with('pembeli')->where('id', $id)->first();
        $bayar = PenjualanByBayar::with('statusKategori')->where('penjualan_id', $id)->where('tipe_pembayaran', 2)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_bayar_supplier.show", compact('title', 'penjualan', 'bayar'));
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
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Nominal harus diisi!');
        }

        $id_penjualan = $request->id_penjualan;
        $nominal = remove_currency($request->nominal);

        $totalPendapatan = Penjualan::with('penjualanByProduk')
            ->where('id', $id_penjualan)
            ->get()
            ->sum(function ($penjualan) {
                return $penjualan->penjualanByProduk->sum(function ($produk) {
                    return $produk->total * (1 - $produk->fee_cv / 100);
                });
            });

        $totalPembayaran = Penjualan::with('penjualanByBayar')
            ->where('id', $id_penjualan)
            ->get()
            ->sum(function ($penjualan) {
                return $penjualan->penjualanByBayar
                    ->where('tipe_pembayaran', 2)
                    ->where('transaction_midtrans_status', 'settlement')
                    ->sum('nominal');
            });
        $sisa_pembayaran = $totalPendapatan - $totalPembayaran;

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
            // CEK KATEGORI PEMBAYARAN
            $kategori_pembayaran = 1;
            if ($totalPembayaran) {
                if ($nominal == $sisa_pembayaran) {
                    $kategori_pembayaran = 3;
                } else {
                    $kategori_pembayaran = 2;
                }
            }

            $filename = null;
            if ($request->hasFile('file')) {
                $filename = time() . '-' . uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move(public_path('assets/uploads/pembayaran'), $filename);
            }

            PenjualanByBayar::create([
                'kode_bayar' => generate_code("PAY", (PenjualanByBayar::orderBy('id', 'desc')->first()->kode_bayar ?? '')),
                'penjualan_id' => $id_penjualan,
                'transaction_midtrans_status' => 'pending',
                'kategori_pembayaran' => $kategori_pembayaran,
                'nominal' => $nominal,
                'tipe_pembayaran' => 2,
                'foto' => $filename,
            ]);

            DB::commit();
            return back()->with('success', 'Tagihan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
