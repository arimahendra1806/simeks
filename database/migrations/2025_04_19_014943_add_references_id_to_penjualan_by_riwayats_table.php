<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penjualan_by_riwayats', function (Blueprint $table) {
            $table->unsignedBigInteger('references_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('penjualan_by_riwayats', function (Blueprint $table) {
            $table->dropColumn('references_id');
        });
    }
};
