<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        // Hapus kolom di tabel produks jika ada
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'satuan_id')) {
                $table->dropColumn('satuan_id');
            }
            if (Schema::hasColumn('produks', 'isi')) {
                $table->dropColumn('isi');
            }
            if (Schema::hasColumn('produks', 'ukuran')) {
                $table->dropColumn('ukuran');
            }
            if (Schema::hasColumn('produks', 'harga')) {
                $table->dropColumn('harga');
            }
            if (Schema::hasColumn('produks', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });

        // Ubah kolom keterangan menjadi alamat di tabel pemasoks jika ada
        if (Schema::hasColumn('pemasoks', 'keterangan')) {
            Schema::table('pemasoks', function (Blueprint $table) {
                $table->dropColumn('keterangan');
                $table->text('alamat');
            });
        }

        // Ubah kolom keterangan menjadi alamat di tabel pembelis jika ada
        if (Schema::hasColumn('pembelis', 'keterangan')) {
            Schema::table('pembelis', function (Blueprint $table) {
                $table->dropColumn('keterangan');
                $table->text('alamat');
            });
        }
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        // Kembalikan nama kolom alamat menjadi keterangan di tabel pemasoks jika ada
        if (Schema::hasColumn('pemasoks', 'alamat')) {
            Schema::table('pemasoks', function (Blueprint $table) {
                $table->dropColumn('alamat');
                $table->text('keterangan');
            });
        }

        // Kembalikan nama kolom alamat menjadi keterangan di tabel pembelis jika ada
        if (Schema::hasColumn('pembelis', 'alamat')) {
            Schema::table('pembelis', function (Blueprint $table) {
                $table->dropColumn('alamat');
                $table->text('keterangan');
            });
        }
    }
};
