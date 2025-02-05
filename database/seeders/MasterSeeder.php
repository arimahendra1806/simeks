<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pilihans')->insert([
            [
                'nama' => 'status',
                'parameter' => '1',
                'isi' => 'Negosiasi',
            ],
            [
                'nama' => 'status',
                'parameter' => '2',
                'isi' => 'Kelengkapan Berkas',
            ],
            [
                'nama' => 'status',
                'parameter' => '3',
                'isi' => 'Menunggu Pembayaran',
            ],
            [
                'nama' => 'status',
                'parameter' => '4',
                'isi' => 'Terbayar',
            ],
            [
                'nama' => 'status',
                'parameter' => '5',
                'isi' => 'Pengiriman',
            ],
            [
                'nama' => 'status',
                'parameter' => '6',
                'isi' => 'Selesai',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '7',
                'isi' => 'Diterima',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '8',
                'isi' => 'Pengajuan Balik',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '9',
                'isi' => 'Pengembalian Barang',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '10',
                'isi' => 'Ganti Baru',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '11',
                'isi' => 'Pengiriman Ulang',
            ],
            [
                'nama' => 'status_pengiriman',
                'parameter' => '12',
                'isi' => 'Pengembalian Uang',
            ],
            [
                'nama' => 'tipe_pembayaran',
                'parameter' => '1',
                'isi' => 'Transfer',
            ],
            [
                'nama' => 'tipe_pembayaran',
                'parameter' => '2',
                'isi' => 'Cash',
            ],
            [
                'nama' => 'kategori_pembayaran',
                'parameter' => '1',
                'isi' => 'Down Payment',
            ],
            [
                'nama' => 'kategori_pembayaran',
                'parameter' => '2',
                'isi' => 'Tempo',
            ],
            [
                'nama' => 'kategori_pembayaran',
                'parameter' => '3',
                'isi' => 'Lunas',
            ],
        ]);
    }
}
