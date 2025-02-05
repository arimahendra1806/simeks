<?php

use App\Models\Penjualan;
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
        Schema::create('penjualan_by_pengirimans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Penjualan::class);
            $table->string('ekspedisi', 150);
            $table->date('tanggal_pengiriman');
            $table->integer('status_pengiriman');
            $table->text('resi');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_by_pengirimans');
    }
};
