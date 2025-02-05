<?php

use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\Satuan;
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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pemasok::class);
            $table->foreignIdFor(Kategori::class);
            $table->foreignIdFor(Satuan::class);
            $table->string('nama', 100);
            $table->text('deskripsi');
            $table->integer('isi');
            $table->string('ukuran', 20);
            $table->double('harga');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
