<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanByPengiriman;
use App\Models\PenjualanByProduk;
use App\Models\PenjualanByRiwayat;
use App\Models\Pilihan;
use App\Models\User;
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
        $data_pemasok = PenjualanByProduk::with('produk.pemasok')->where('penjualan_id', $id)->first();
        $data_alamat = $data_pemasok ? $data_pemasok->produk->pemasok->alamat : '';

        return view("admin.penjualan_pengiriman.show", compact('title', 'penjualan', 'pengiriman', 'data_alamat'));
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
                'tanggal_pengiriman' => formate_date($request->tanggal_pengiriman),
                'nama_driver' => $request->nama_driver,
                'telepon_driver' => normalize_phone_number($request->telepon_driver),
                'keterangan' => $request->keterangan,
                'alamat_mulai' => $request->alamat_mulai,
                'alamat_selesai' => $request->alamat_selesai,
                'status_pengiriman' => 7,
                'id_user' => auth()->user()->id,
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

    public function confirm_wa($id)
    {
        $data_pengiriman = PenjualanByPengiriman::where('id', $id)->first();
        $data_token = Pilihan::where('nama', 'token_wa')->first();
        $data_admin = User::where('id', $data_pengiriman->id_user)->first();

        if (!$data_token) {
            return back()->with('error', 'Token WhatsApp tidak ditemukan!');
        }

        if (!$data_pengiriman) {
            return back()->with('error', 'Data pengiriman tidak ditemukan!');
        }

        $phone = 'Belum ada nomor telepon yang terdaftar';
        if ($data_admin && $data_admin->phone) {
            $phone = $data_admin->phone;
        }

        $message = 'Berikut link pembaruan status pengiriman: ' . "\n";
        $message .= route('status_shipment', encrypt_64($data_pengiriman->id)) . "\n\n";
        $message .= 'Silahkan klik link diatas untuk melihat status pengiriman. Jika ada kendala, silahkan hubungi admin : ' . "\n" . $phone . "\n\n";
        $message .= 'Terima kasih. @CV ALMEA KAUSA ETERNA';

        $response = send_wa(($data_token->isi ?? ""), ($data_pengiriman->telepon_driver ?? ""), $message);

        if ($response['error']) {
            return back()->with('error', 'Gagal mengirim pesan WhatsApp: ' . $response['error_msg']);
        }

        return back()->with('success', 'Pesan Berhasil Dikirim');
    }
}
