<?php

use App\Models\Industri;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            $table->string('kode_transaksi')->after('id')->nullable();
        });

        Schema::create('industris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pasars', function (Blueprint $table) {
            $table->foreignIdFor(Industri::class)->nullable()->after('id');
        });

        Schema::table('pembelis', function (Blueprint $table) {
            $table->foreignIdFor(Industri::class)->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan_by_bayars', 'kode_transaksi')) {
                $table->dropColumn('kode_transaksi');
            }
        });

        Schema::dropIfExists('industris');

        Schema::table('pasars', function (Blueprint $table) {
            if (Schema::hasColumn('pasars', 'industri_id')) {
                $table->dropColumn('industri_id');
            }
        });

        Schema::table('pembelis', function (Blueprint $table) {
            if (Schema::hasColumn('pembelis', 'industri_id')) {
                $table->dropColumn('industri_id');
            }
        });
    }
};
