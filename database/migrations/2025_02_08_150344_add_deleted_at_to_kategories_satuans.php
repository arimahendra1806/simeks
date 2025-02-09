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
        Schema::table('kategoris', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('satuans', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            if (Schema::hasColumn('kategoris', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('satuans', function (Blueprint $table) {
            if (Schema::hasColumn('satuans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};
