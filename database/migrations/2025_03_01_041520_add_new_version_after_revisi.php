<?php

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
        // Hapus tabel yang tidak dibutuhkan
        Schema::dropIfExists('provinsis');
        Schema::dropIfExists('kotas');
        Schema::dropIfExists('penjualan_by_pengembalians');

        // Hapus kolom provinsi_id dan kota_id di tabel produk
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'provinsi_id')) {
                $table->dropColumn('provinsi_id');
            }

            if (Schema::hasColumn('produks', 'kota_id')) {
                $table->dropColumn('kota_id');
            }
        });

        // Tambahkan kolom alamat di tabel produk
        Schema::table('produks', function (Blueprint $table) {
            $table->string('alamat')->nullable();
        });

        // Hapus kolom yang tidak diperlukan di tabel pasars
        Schema::table('pasars', function (Blueprint $table) {
            if (Schema::hasColumn('pasars', 'prefensi')) {
                $table->dropColumn('prefensi');
            }

            if (Schema::hasColumn('pasars', 'potensi')) {
                $table->dropColumn('potensi');
            }

            if (Schema::hasColumn('pasars', 'sumber_informasi')) {
                $table->dropColumn('sumber_informasi');
            }
        });

        // Mengubah nama kolom kode_transaksi menjadi kode_bayar di tabel penjualan_by_bayars
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan_by_bayars', 'kode_transaksi')) {
                $table->renameColumn('kode_transaksi', 'kode_bayar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom alamat dari tabel produk
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });

        // Menambahkan kembali kolom yang dihapus di tabel pasars
        Schema::table('pasars', function (Blueprint $table) {
            $table->string('prefensi')->nullable();
            $table->string('potensi')->nullable();
            $table->string('sumber_informasi')->nullable();
        });

        // Mengubah nama kolom kode_bayar kembali menjadi kode_transaksi di tabel penjualan_by_bayars
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan_by_bayars', 'kode_bayar')) {
                $table->renameColumn('kode_bayar', 'kode_transaksi');
            }
        });
    }
};
