<?php

use App\Models\Bank;
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
        Schema::create('penjualan_by_bayars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Penjualan::class);
            $table->foreignIdFor(Bank::class);
            $table->integer('tipe_pembayaran');
            $table->integer('kategori_pembayaran');
            $table->double('nominal');
            $table->text('foto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_by_bayars');
    }
};
