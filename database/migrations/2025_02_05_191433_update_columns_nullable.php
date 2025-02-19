<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
                    if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                        $table->string($column)->nullable()->change();
                    }
                }
            });
        }
    }

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

            foreach ($columns as $column) {
                if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                    DB::table($tableName)->whereNull($column)->update([$column => '']);
                }
            }

            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                        $table->string($column)->nullable(false)->change();
                    }
                }
            });
        }
    }
};
