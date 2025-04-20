<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan_by_produks', function (Blueprint $table) {
            $table->unsignedBigInteger('satuan_id')->nullable()->after('id');
            $table->double('qty')->nullable()->after('satuan_id');

            $table->double('kuantitas')->nullable()->change();
            $table->double('harga')->nullable()->change();
            $table->double('diskon_nominal')->nullable()->change();
            $table->double('diskon_persen')->nullable()->change();
            $table->double('total')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penjualan_by_produks', function (Blueprint $table) {
            $table->dropColumn(['satuan_id', 'qty']);
            $table->string('kuantitas', 255)->nullable()->change();
            $table->string('harga', 255)->nullable()->change();
            $table->string('diskon_nominal', 255)->nullable()->change();
            $table->string('diskon_persen', 255)->nullable()->change();
            $table->string('total', 255)->nullable()->change();
        });
    }
};
