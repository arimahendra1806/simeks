<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransConfig;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\PenjualanByBayar;
use App\Models\PenjualanByPengiriman;
use App\Models\PenjualanByPengirimanDarurat;
use App\Models\PenjualanByProduk;
use App\Models\PenjualanByRiwayat;
use App\Models\Pilihan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Midtrans\Notification;
use Midtrans\Snap;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        $products = Produk::with('kategori', 'produkByFoto', 'produkBySatuan')->get();

        return view('landing.index', compact('categories', 'products'));
    }

    public function invoice_pay($params)
    {
        $id = decrypt_64($params);

        $data_penjualan = PenjualanByBayar::where('id', $id)->first();

        if (!$data_penjualan) {
            return abort(404);
        }

        // UPDATE CANCEL PEMBAYARAN SEBELUMNYA
        PenjualanByBayar::where('penjualan_id', $id)
            ->where('transaction_midtrans_status', null)
            ->whereDate('created_at', '<', date('Y-m-d'))
            ->update([
                'transaction_midtrans_status' => 'expire',
            ]);

        $penjualan = Penjualan::with('pembeli')->where('id', $data_penjualan->penjualan_id)->first();
        $produk = PenjualanByProduk::with('satuan', 'produk')->where('penjualan_id', $data_penjualan->penjualan_id)->get();
        $bayar = PenjualanByBayar::with('statusKategori')->where('id', $id)->first();

        return view('landing.invoice_pay', compact('penjualan', 'produk', 'bayar'));
    }

    public function invoice_pay_now(Request $request)
    {
        MidtransConfig::config();

        $params = [
            'transaction_details' => [
                'order_id' => 'INV-' . date('YmdHis'),
                // 'gross_amount' => 1,
                'gross_amount' => $request->nominal,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'email' => $request->email,
            ],
            'enable_payments' => [
                "credit_card",
                "cimb_clicks",
                "bca_klikbca",
                "bca_klikpay",
                "bri_epay",
                "echannel",
                "permata_va",
                "bca_va",
                "bni_va",
                "bri_va",
                "other_va",
                "indomaret",
                "alfamart",
                "danamon_online",
                "akulaku",
                "shopeepay"
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }

    public function callback_invoice()
    {
        // Ambil notifikasi dari Midtrans
        $notification = new Notification();

        // Dapatkan status transaksi
        $transactionId = $notification->transaction_id;
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        PenjualanByBayar::where('kode_bayar', $orderId)
            ->update([
                'transaction_midtrans_id' => $transactionId,
                'transaction_midtrans_status' => $transactionStatus,
                'transaction_midtrans_time' => date('Y-m-d H:i:s'),
            ]);

        // Return response
        return response()->json(['status' => 'success']);
    }

    public function update_status_invoice_pay(Request $request)
    {
        $order_id = $request->order_id;
        $transaction_status = $request->transaction_status;

        PenjualanByBayar::where('id', $order_id)
            ->update([
                'transaction_midtrans_id' => $request->transaction_id,
                'transaction_midtrans_status' => $transaction_status,
                'transaction_midtrans_time' => date('Y-m-d H:i:s'),
            ]);

        $data_penjualan = PenjualanByBayar::with('penjualan')->where('id', $order_id)->first();
        $terbayar = $data_penjualan->penjualan->total_terbayar + $data_penjualan->nominal;
        $sisa = $data_penjualan->penjualan->sisa_pembayaran - $data_penjualan->nominal;

        $status = '4';
        if ($sisa <= 0) {
            $status = '6';
        }
        Penjualan::where('id', $data_penjualan->penjualan_id)
            ->update([
                'status' => $status,
                'total_terbayar' => $terbayar,
                'sisa_pembayaran' => $sisa,
            ]);

        PenjualanByRiwayat::create([
            'references_id' => $data_penjualan->penjualan_id,
            'penjualan_id' => 0,
            'tipe' => 1,
            'status' => $status,
            'tanggal' => date('Y-m-d'),
        ]);

        return response()->json(['status' => $transaction_status]);
    }

    public function invoice_pay_success($params)
    {
        $id = decrypt_64($params);

        $data_penjualan = PenjualanByBayar::where('id', $id)->first();

        if (!$data_penjualan) {
            return abort(404);
        }

        $penjualan = Penjualan::with('pembeli')->where('id', $data_penjualan->penjualan_id)->first();
        $produk = PenjualanByProduk::with('satuan', 'produk')->where('penjualan_id', $data_penjualan->penjualan_id)->get();
        $bayar = PenjualanByBayar::with('statusKategori')->where('id', $id)->first();

        return view('landing.invoice_pay_success', compact('penjualan', 'produk', 'bayar'));
    }

    public function status_shipment($params)
    {
        $id = decrypt_64($params);

        $data_penjualan = PenjualanByPengiriman::where('id', $id)->first();

        if (!$data_penjualan) {
            return abort(404);
        }

        $penjualan = Penjualan::with('pembeli')->where('id', $data_penjualan->penjualan_id)->first();
        $produk = PenjualanByProduk::with('satuan', 'produk')->where('penjualan_id', $data_penjualan->penjualan_id)->get();
        $pengiriman = PenjualanByPengiriman::with('statusPengiriman', 'adminPengiriman')->where('id', $id)->first();
        $laporan = PenjualanByPengirimanDarurat::where('pengiriman_id', $id)->get();

        return view('landing.status_shipment', compact('penjualan', 'produk', 'pengiriman', 'laporan'));
    }

    public function status_shipment_update(Request $request)
    {
        PenjualanByPengiriman::where('id', $request->id)
            ->update([
                'status_pengiriman' => $request->status,
                'keterangan_kirim' => $request->keterangan_kirim,
            ]);

        PenjualanByRiwayat::create([
            'references_id' => $request->id_penjualan,
            'penjualan_id' => 0,
            'tipe' => 2,
            'status' => $request->status,
            'tanggal' => date('Y-m-d'),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function pengiriman_darurat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Tidak boleh ada yang kosong!');
        }

        PenjualanByPengirimanDarurat::create([
            'pengiriman_id' => $request->pengiriman_id,
            'keterangan' => $request->keterangan,
        ]);

        $data_pengiriman = PenjualanByPengiriman::where('id', $request->pengiriman_id)->first();

        $message = "Laporan Darurat Pengiriman\n";
        $message .= "Driver: " . $data_pengiriman->nama_driver . "\n";
        $message .= "Keterangan: " . $request->keterangan . "\n\n";
        $message .= "Silakan cek di status pengiriman untuk detail lebih lanjut." . "\n";
        $message .= route('status_shipment', encrypt_64($request->pengiriman_id)) . "\n\n";
        $message .= "Terima kasih. @CV ALMEA KAUSA ETERNA";

        $data_pengiriman = PenjualanByPengiriman::where('id', $request->pengiriman_id)->first();
        $data_token = Pilihan::where('nama', 'token_wa')->first();
        $data_admin = User::where('id', $data_pengiriman->id_user)->first();

        if (!$data_token) {
            return back()->with('error', 'Token WhatsApp tidak ditemukan!');
        }

        if (!$data_pengiriman) {
            return back()->with('error', 'Data pengiriman tidak ditemukan!');
        }

        $response = send_wa(($data_token->isi ?? ""), ($data_admin->phone ?? ""), $message);

        return back()->with('success', 'Pesan Berhasil Dikirim');
    }
}
