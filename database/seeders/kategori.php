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
            'id_museum' => 1,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Umum'
        ]);
        ModelsKategori::create([
            'id' => 2,
            'id_museum' => 1,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Pelajar'
        ]);
        ModelsKategori::create([
            'id' => 3,
            'id_museum' => 1,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Mahasiswa'
        ]);
        ModelsKategori::create([
            'id' => 4,
            'id_museum' => 1,
            'min' => 50,
            'max' => 500,
            'nama_kategori' => 'Rombongan Umum'
        ]);
        ModelsKategori::create([
            'id' => 5,
            'id_museum' => 1,
            'min' => 50,
            'max' => 500,
            'nama_kategori' => 'Rombongan Pelajar'
        ]);
        ModelsKategori::create([
            'id' => 6,
            'id_museum' => 1,
            'min' => 1,
            'max' => 50,
            'nama_kategori' => 'Wisatawan Asing'
        ]);
        ModelsKategori::create([
            'id' => 7,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Siswa'
        ]);
        ModelsKategori::create([
            'id' => 8,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Mahasiswa'
        ]);
        ModelsKategori::create([
            'id' => 9,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Peneliti'
        ]);
        ModelsKategori::create([
            'id' => 10,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Guru'
        ]);
        ModelsKategori::create([
            'id' => 11,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Dosen'
        ]);
        ModelsKategori::create([
            'id' => 12,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Umum'
        ]);
        ModelsKategori::create([
            'id' => 13,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Warga Negara Asing'
        ]);
        ModelsKategori::create([
            'id' => 14,
            'id_museum' => 2,
            'min' => 1,
            'max' => 500,
            'nama_kategori' => 'Seniman'
        ]);
    }
}
