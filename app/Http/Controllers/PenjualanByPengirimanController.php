<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanByPengiriman;
use App\Models\PenjualanByRiwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanByPengirimanController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Pengiriman';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->where('status', '>', 3)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_pengiriman.index", compact('title', 'data'));
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
        $pengiriman = PenjualanByPengiriman::with('statusPengiriman')->where('penjualan_id', $id)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_pengiriman.show", compact('title', 'penjualan', 'pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjualanByPengiriman $PenjualanByPengiriman)
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
    public function destroy($id)
    {
        PenjualanByPengiriman::where('id', $id)->delete();

        return back()->with('success', 'Data berhasil diihapus!');
    }

    public function generate_kirim(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ekspedisi' => 'required',
            'tanggal_pengiriman' => 'required',
            'nama_driver' => 'required',
            'telepon_driver' => 'required',
            'alamat_mulai' => 'required',
            'alamat_selesai' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Tidak boleh ada yang kosong!');
        }

        DB::beginTransaction();
        try {
            PenjualanByPengiriman::create([
                'penjualan_id' => $request->id_penjualan,
                'ekspedisi' => $request->ekspedisi,
                'tanggal_pengiriman' => indo_to_date($request->tanggal_pengiriman),
                'nama_driver' => $request->nama_driver,
                'telepon_driver' => normalize_phone_number($request->telepon_driver),
                'keterangan' => $request->keterangan,
                'alamat_mulai' => $request->alamat_mulai,
                'alamat_selesai' => $request->alamat_selesai,
                'status_pengiriman' => 7
            ]);

            PenjualanByRiwayat::create([
                'references_id' => $request->id_penjualan,
                'penjualan_id' => 0,
                'tipe' => 2,
                'status' => 7,
                'tanggal' => date('Y-m-d'),
            ]);

            DB::commit();
            return back()->with('success', 'Pengiriman berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
