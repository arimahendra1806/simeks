<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NegaraImportSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = storage_path('app/simeks_negara.sql');

        if (File::exists($filePath)) {
            $queries = explode(";\n", File::get($filePath));

            foreach ($queries as $query) {
                if (trim($query)) {
                    DB::unprepared($query);
                }
            }

            $this->command->info('SQL file imported successfully!');
        } else {
            $this->command->error('File SQL not found!');
        }
    }
}
