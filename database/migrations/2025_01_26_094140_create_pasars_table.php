<?php

use App\Models\Negara;
use App\Models\Pembeli;
use App\Models\Produk;
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
        Schema::create('pasars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Negara::class);
            $table->foreignIdFor(Pembeli::class);
            $table->foreignIdFor(Produk::class);
            $table->text('prefensi');
            $table->text('regulasi');
            $table->text('potensi');
            $table->text('kompetitor');
            $table->text('sumber_informasi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasars');
    }
};
