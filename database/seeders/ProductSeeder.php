<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Truncate tabel untuk mengosongkan data dan mereset ID
        DB::table('produk_by_satuans')->truncate();
        DB::table('produk_by_fotos')->truncate();
        DB::table('produks')->truncate();

        // Menambahkan data produk ke tabel 'produks' dengan kategori_id = 1
        DB::table('produks')->insert([
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Jahe Kering',
                'deskripsi' => 'Kaya akan kandungan minyak atsiri, jahe kering premium ini memiliki penampilan yang menarik dan terbentuk dengan baik tanpa lubang, memastikan kualitas terbaik untuk berbagai aplikasi.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Jahe Segar',
                'deskripsi' => 'Jahe segar dipanen dengan hati-hati pada tingkat kematangan penuh untuk memastikan kualitas terbaik dan tersedia dalam berbagai ukuran, mulai dari 80g hingga 250g, dapat disesuaikan untuk memenuhi spesifikasi pembeli, dengan pengolahan yang teliti untuk menjaga keunggulannya.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Kunyit Kering',
                'deskripsi' => 'Tersedia dalam berbagai tingkat curcumin untuk memenuhi berbagai kebutuhan, kunyit iris ini memiliki warna cerah dan dipotong secara manual untuk menjaga bentuk dan ketebalannya.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Jari Kunyit',
                'deskripsi' => 'Tersedia dalam spesifikasi polesan tunggal, polesan ganda, atau tanpa polesan, jari kunyit ini memerlukan waktu persiapan kurang dari satu bulan, memastikan efisiensi tanpa mengorbankan kualitas.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Lada Hitam',
                'deskripsi' => 'Sumber terbaik dari perkebunan di Bangka dan Lampung, diakui secara global sebagai lada terbaik di dunia, menawarkan kualitas tak tertandingi dan spesifikasi GL yang dapat disesuaikan mulai dari 500-600 untuk memenuhi kebutuhan pembeli yang beragam.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Lada Putih',
                'deskripsi' => 'Sumber terbaik dari perkebunan di Bangka dan Lampung, Lada Putih Muntok diakui secara global sebagai lada terbaik di dunia, menawarkan kualitas tak tertandingi dan spesifikasi GL yang dapat disesuaikan mulai dari 600-630 untuk memenuhi kebutuhan pembeli yang beragam.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Pinang',
                'deskripsi' => 'Pinang dari varietas Betara, yang berasal dari Jambi, dikenal karena kualitas superiornya dengan kandungan alkaloid dan tanin yang tinggi. Memiliki warna cerah yang mencolok dan melalui proses pengeringan dengan sinar matahari untuk memastikan kualitas optimal. Tersedia dalam bentuk utuh dan setengah belah, dapat disiapkan sesuai spesifikasi pembeli.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Kapulaga',
                'deskripsi' => 'Dikenal sebagai "Ratu Rempah", Kapulaga Jawa dari Indonesia memiliki warna yang menarik dari putih hingga keemasan dan kandungan kelembapan di bawah 10%, diproses dengan hati-hati untuk menjaga kualitas unggulnya.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Lengkuas',
                'deskripsi' => 'Diperoleh dari perkebunan dataran tinggi untuk kualitas luar biasa, lengkuas premium ini kaya akan galangin untuk rasa dan aroma yang kuat, dengan kandungan cineol tinggi yang menjadikannya ideal untuk penggunaan medis.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Kayu Manis',
                'deskripsi' => 'Ditanam di Kerinci, wilayah utama untuk produksi kayu manis, rempah premium ini tersedia dalam berbagai ukuran potongan dan dapat disesuaikan untuk memenuhi spesifikasi pembeli.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Pala',
                'deskripsi' => 'Dikenal sebagai Pala Siau dari Maluku, Indonesia adalah eksportir pala terbesar di dunia. Menawarkan kandungan minyak atsiri yang tinggi dan berbagai spesifikasi, termasuk grade ABC, cacat (SS), mace, patah, dan pala dengan kulit.',
            ],
            [
                'pemasok_id' => 1,
                'kategori_id' => 1, // Kategori Rempah
                'nama' => 'Cengkeh',
                'deskripsi' => 'Dipetik dengan tangan dari cengkeh Lalpari terbaik, terklasifikasi AB6 untuk kualitas premium, memiliki kandungan minyak yang kaya, ukuran seragam, dan aroma yang kuat, menjadikannya ideal untuk berbagai aplikasi.',
            ],
        ]);

        // Menambahkan gambar produk ke tabel 'produk_by_fotos'
        DB::table('produk_by_fotos')->insert([
            [
                'produk_id' => 1, // Jahe Kering
                'file' => 'jahe-kering.jpg',
            ],
            [
                'produk_id' => 2, // Jahe Segar
                'file' => 'jahe-segar.jpg',
            ],
            [
                'produk_id' => 3, // Kunyit Kering
                'file' => 'kunyit-kering.jpg',
            ],
            [
                'produk_id' => 4, // Jari Kunyit
                'file' => 'jari-kunyit.jpg',
            ],
            [
                'produk_id' => 5, // Lada Hitam
                'file' => 'lada-hitam.jpg',
            ],
            [
                'produk_id' => 6, // Lada Putih
                'file' => 'lada-putih.jpg',
            ],
            [
                'produk_id' => 7, // Pinang
                'file' => 'pinang.jpg',
            ],
            [
                'produk_id' => 8, // Kapulaga
                'file' => 'kapulaga.jpg',
            ],
            [
                'produk_id' => 9, // Lengkuas
                'file' => 'lengkuas.jpg',
            ],
            [
                'produk_id' => 10, // Kayu Manis
                'file' => 'kayu-manis.jpg',
            ],
            [
                'produk_id' => 11, // Pala
                'file' => 'pala.jpg',
            ],
            [
                'produk_id' => 12, // Cengkeh
                'file' => 'cengkeh.jpg',
            ],
        ]);

        // Menambahkan satuan dan harga ke tabel 'produk_by_satuans'
        DB::table('produk_by_satuans')->insert([
            // Jahe Kering
            [
                'produk_id' => 1,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '50000',
            ],
            [
                'produk_id' => 1,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '10000',
            ],

            // Jahe Segar
            [
                'produk_id' => 2,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '60000',
            ],
            [
                'produk_id' => 2,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '8000',
            ],

            // Kunyit Kering
            [
                'produk_id' => 3,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '70000',
            ],
            [
                'produk_id' => 3,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '15000',
            ],

            // Jari Kunyit
            [
                'produk_id' => 4,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '75000',
            ],
            [
                'produk_id' => 4,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '12000',
            ],

            // Lada Hitam
            [
                'produk_id' => 5,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '200000',
            ],
            [
                'produk_id' => 5,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '25000',
            ],

            // Lada Putih
            [
                'produk_id' => 6,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '220000',
            ],
            [
                'produk_id' => 6,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '28000',
            ],

            // Pinang
            [
                'produk_id' => 7,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '100000',
            ],
            [
                'produk_id' => 7,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '15000',
            ],

            // Kapulaga
            [
                'produk_id' => 8,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '300000',
            ],
            [
                'produk_id' => 8,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '35000',
            ],

            // Lengkuas
            [
                'produk_id' => 9,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '60000',
            ],
            [
                'produk_id' => 9,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '10000',
            ],

            // Kayu Manis
            [
                'produk_id' => 10,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '120000',
            ],
            [
                'produk_id' => 10,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '15000',
            ],

            // Pala
            [
                'produk_id' => 11,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '180000',
            ],
            [
                'produk_id' => 11,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '22000',
            ],

            // Cengkeh
            [
                'produk_id' => 12,
                'satuan_id' => 1, // Satuan Kilogram
                'kuantitas' => '1',
                'harga' => '250000',
            ],
            [
                'produk_id' => 12,
                'satuan_id' => 2, // Satuan Gram
                'kuantitas' => '100',
                'harga' => '30000',
            ],
        ]);
    }
}
