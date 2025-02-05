<?php

use App\Models\Dokumen;
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
        Schema::create('penjualan_by_dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Penjualan::class);
            $table->foreignIdFor(Dokumen::class);
            $table->text('file');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_by_dokumens');
    }
};
