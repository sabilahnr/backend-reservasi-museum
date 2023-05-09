<?php

namespace Database\Seeders;

use App\Models\kategori as ModelsKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsKategori::create([
            'id' => 1,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Umum',
            'nama_kategori_en' => 'Common',
            'id_museum' => 1,
            'hari_biasa' => 7500,
            'hari_libur' => 10000
        ]);
        ModelsKategori::create([
            'id' => 2,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Pelajar',
            'nama_kategori_en' => 'Student',
            'id_museum' => 1,
            'hari_biasa' => 5000,
            'hari_libur' => 7500
        ]);
        ModelsKategori::create([
            'id' => 3,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Mahasiswa',
            'nama_kategori_en' => 'Student',
            'id_museum' => 1,
            'hari_biasa' => 5000,
            'hari_libur' => 4000
        ]);
        ModelsKategori::create([
            'id' => 4,
            'min' => 50,
            'max' => 500,
            'nama_kategori' => 'Rombongan Umum',
            'nama_kategori_en' => 'Many common',
            'id_museum' => 1,
            'hari_biasa' => 5000,
            'hari_libur' => 7500
        ]);
        ModelsKategori::create([
            'id' => 5,
            'min' => 50,
            'max' => 500,
            'nama_kategori' => 'Rombongan Pelajar',
            'nama_kategori_en' => 'Many Student',
            'id_museum' => 1,
            'hari_biasa' => 4000,
            'hari_libur' => 5000
        ]);
        ModelsKategori::create([
            'id' => 6,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Bule',
            'nama_kategori_en' => 'Foreigner',
            'id_museum' => 1,
            'hari_biasa' => 15000,
            'hari_libur' => 20000
        ]);
        ModelsKategori::create([
            'id' => 7,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Siswa',
            'nama_kategori_en' => 'Student',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 8,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Mahasiswa',
            'nama_kategori_en' => 'Student',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 9,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Peneliti',
            'nama_kategori_en' => 'Common',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 10,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Guru',
            'nama_kategori_en' => 'Common',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 11,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Dosen',
            'nama_kategori_en' => 'Common',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 12,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Umum',
            'nama_kategori_en' => 'Common',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 13,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Warga Negara Asing',
            'nama_kategori_en' => 'Foreignrt',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        ModelsKategori::create([
            'id' => 14,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Seniman',
            'nama_kategori_en' => 'Artist',
            'id_museum' => 2,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
    }
}
