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
            'nama_kategori' => 'Umum'
        ]);
    }
}
