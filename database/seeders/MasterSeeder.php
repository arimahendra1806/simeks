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

        DB::table('banks')->insert([
            [
                'nama' => 'BRI',
            ],
            [
                'nama' => 'BNI',
            ],
            [
                'nama' => 'BTN',
            ],
        ]);

        DB::table('dokumens')->insert([
            [
                'nama' => 'KTP',
            ],
            [
                'nama' => 'NPWP',
            ],
            [
                'nama' => 'LEGALITAS',
            ],
        ]);

        DB::table('industris')->insert([
            [
                'nama' => 'FNB',
            ],
            [
                'nama' => 'SUPERMAERKET',
            ],
        ]);

        DB::table('kategoris')->insert([
            [
                'nama' => 'PALAWIJA',
            ],
        ]);

        DB::table('satuans')->insert([
            [
                'nama' => 'GRAM',
            ],
            [
                'nama' => 'KILOGRAM',
            ],
            [
                'nama' => 'KWINTAL',
            ],
        ]);

        DB::table('pemasoks')->insert([
            [
                'negara_id' => '63',
                'nama' => 'SANTOSO',
                'email' => 'cvsentosa@example.com',
                'telepon' => '08123456789',
                'perusahaan' => 'CV SENTOSA',
                'alamat' => 'Jln. Jend. Sudirman No. 20, Jakarta Pusat',
            ],
        ]);

        DB::table('pembelis')->insert([
            [
                'industri_id' => '1',
                'negara_id' => '64',
                'nama' => 'RICHARD',
                'email' => 'burgersinc@example.com',
                'telepon' => '08123456789',
                'perusahaan' => 'BURGERS INC',
                'alamat' => 'Al-Karada Street, Baghdad',
            ],
        ]);

        DB::table('produks')->insert([
            [
                'pemasok_id' => '1',
                'kategori_id' => '1',
                'nama' => 'Fresh Ginger',
                'deskripsi' => 'Export Quality Fresh White Ginger from the Land of Indonesia | Fresh Ginger Available in any size starting from 100 gr up, 150 gr up, 200 gr up, and 250 gr up.',
            ],
        ]);

        DB::table('produk_by_fotos')->insert([
            [
                'produk_id' => '1',
                'file' => 'IMG_8803.jpg',
            ],
        ]);

        DB::table('produk_by_satuans')->insert([
            [
                'produk_id' => '1',
                'satuan_id' => '1',
                'kuantitas' => '100',
                'harga' => '20000',
            ],
            [
                'produk_id' => '1',
                'satuan_id' => '1',
                'kuantitas' => '150',
                'harga' => '25000',
            ],
            [
                'produk_id' => '1',
                'satuan_id' => '1',
                'kuantitas' => '200',
                'harga' => '30000',
            ],
            [
                'produk_id' => '1',
                'satuan_id' => '1',
                'kuantitas' => '250',
                'harga' => '35000',
            ],
        ]);
    }
}
