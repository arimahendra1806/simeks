<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penjualan_by_pengirimans', function (Blueprint $table) {
            $table->string('nama_driver')->nullable()->after('id'); // Ganti 'id' dengan kolom terakhir sebelumnya kalau mau lebih rapi
            $table->string('telepon_driver')->nullable()->after('nama_driver');
        });
    }

    public function down()
    {
        Schema::table('penjualan_by_pengirimans', function (Blueprint $table) {
            $table->dropColumn(['nama_driver', 'telepon_driver']);
        });
    }
};
