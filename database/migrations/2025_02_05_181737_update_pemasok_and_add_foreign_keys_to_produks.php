<?php

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->foreignIdFor(Provinsi::class)->nullable()->after('kategori_id');
            $table->foreignIdFor(Kota::class)->nullable()->after('provinsi_id');
        });

        Schema::table('pemasoks', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'provinsi_id', 'kota_id']);
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'provinsi_id')) {
                $table->dropColumn('provinsi_id');
            }

            if (Schema::hasColumn('produks', 'kota_id')) {
                $table->dropColumn('kota_id');
            }
        });

        Schema::table('pemasoks', function (Blueprint $table) {
            if (!Schema::hasColumn('pemasoks', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            if (!Schema::hasColumn('pemasoks', 'provinsi_id')) {
                $table->unsignedBigInteger('provinsi_id')->after('negara_id');
            }

            if (!Schema::hasColumn('pemasoks', 'kota_id')) {
                $table->unsignedBigInteger('kota_id')->after('provinsi_id');
            }
        });
    }
};
