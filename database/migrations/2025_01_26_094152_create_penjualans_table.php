<?php

use App\Models\Pemasok;
use App\Models\Pembeli;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pembeli::class);
            $table->foreignIdFor(Pemasok::class);
            $table->string('kode_transaksi', 150);
            $table->date('tanggal_negosiasi');
            $table->text('hasil_negosiasi');
            $table->text('permintaan');
            $table->date('tanggal_pembelian');
            $table->double('total_pembelian');
            $table->double('ppn');
            $table->double('pph');
            $table->double('diskon_nominal');
            $table->double('diskon_persen');
            $table->double('biaya_pengiriman');
            $table->double('total_pembayaran');
            $table->double('total_terbayar');
            $table->double('sisa_pembayaran');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
