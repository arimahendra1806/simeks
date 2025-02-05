<?php

use App\Models\Kota;
use App\Models\Negara;
use App\Models\Provinsi;
use App\Models\User;
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
        Schema::create('pemasoks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Negara::class);
            $table->foreignIdFor(Provinsi::class);
            $table->foreignIdFor(Kota::class);
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->string('telepon', 20);
            $table->string('perusahaan', 100);
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasoks');
    }
};
