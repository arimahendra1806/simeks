<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            $table->string('transaction_midtrans_id')->nullable()->after('id');
            $table->string('transaction_midtrans_status')->nullable()->after('transaction_midtrans_id');
            $table->timestamp('transaction_midtrans_time')->nullable()->after('transaction_midtrans_status');
        });
    }

    public function down()
    {
        Schema::table('penjualan_by_bayars', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan_by_bayars', 'transaction_midtrans_id')) {
                $table->dropColumn('transaction_midtrans_id');
            }

            if (Schema::hasColumn('penjualan_by_bayars', 'transaction_midtrans_status')) {
                $table->dropColumn('transaction_midtrans_status');
            }

            if (Schema::hasColumn('penjualan_by_bayars', 'transaction_midtrans_time')) {
                $table->dropColumn('transaction_midtrans_time');
            }
        });
    }
};
