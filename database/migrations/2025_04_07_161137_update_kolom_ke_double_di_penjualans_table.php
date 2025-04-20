<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->double('total_pembelian')->nullable()->change();
            $table->double('ppn')->nullable()->change();
            $table->double('pph')->nullable()->change();
            $table->double('diskon_nominal')->nullable()->change();
            $table->double('diskon_persen')->nullable()->change();
            $table->double('biaya_pengiriman')->nullable()->change();
            $table->double('total_pembayaran')->nullable()->change();
            $table->double('total_terbayar')->nullable()->change();
            $table->double('sisa_pembayaran')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->string('total_pembelian', 255)->nullable()->change();
            $table->string('ppn', 255)->nullable()->change();
            $table->string('pph', 255)->nullable()->change();
            $table->string('diskon_nominal', 255)->nullable()->change();
            $table->string('diskon_persen', 255)->nullable()->change();
            $table->string('biaya_pengiriman', 255)->nullable()->change();
            $table->string('total_pembayaran', 255)->nullable()->change();
            $table->string('total_terbayar', 255)->nullable()->change();
            $table->string('sisa_pembayaran', 255)->nullable()->change();
        });
    }
};
