<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MasterSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // ProvinsiImportSqlSeeder::class,
            // KotaImportSqlSeeder::class,
            NegaraImportSqlSeeder::class,
            ProductSeeder::class
        ]);
    }
}
