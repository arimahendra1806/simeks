<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = DB::select('SHOW TABLES');
        $excludedTables = [
            'failed_jobs',
            'migrations',
            'password_reset_tokens',
            'roles',
            'users'
        ];

        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};

            if (in_array($tableName, $excludedTables)) {
                continue;
            }

            $columns = Schema::getColumnListing($tableName);

            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    if (str_ends_with($column, '_id') && $column !== 'id') {
                        // Ubah kolom dengan _id menjadi bigint
                        $table->bigInteger($column)->nullable()->change();
                    }
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = DB::select('SHOW TABLES');
        $excludedTables = [
            'failed_jobs',
            'migrations',
            'password_reset_tokens',
            'roles',
            'users'
        ];

        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};

            if (in_array($tableName, $excludedTables)) {
                continue;
            }

            $columns = Schema::getColumnListing($tableName);

            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    if (str_ends_with($column, '_id') && $column !== 'id') {
                        // Kembalikan kolom _id menjadi varchar
                        $table->string($column)->nullable()->change();
                    }
                }
            });
        }
    }
};
