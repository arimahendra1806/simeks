<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            $table->double('nominal')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            $table->string('nominal', 255)->nullable()->change();
        });
    }
};
