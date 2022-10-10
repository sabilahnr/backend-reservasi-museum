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
            'nama_kategori' => 'umum'
        ]);
        ModelsKategori::create([
            'id' => 2,
            'id_museum' => 1,
            'nama_kategori' => 'pelajar'
        ]);
        ModelsKategori::create([
            'id' => 3,
            'id_museum' => 1,
            'nama_kategori' => 'mahasiswa'
        ]);
        ModelsKategori::create([
            'id' => 4,
            'id_museum' => 1,
            'nama_kategori' => 'rombongan umum'
        ]);
        ModelsKategori::create([
            'id' => 5,
            'id_museum' => 1,
            'nama_kategori' => 'rombongan pelajar'
        ]);
        ModelsKategori::create([
            'id' => 6,
            'id_museum' => 1,
            'nama_kategori' => 'wisatawan asing'
        ]);
        ModelsKategori::create([
            'id' => 7,
            'id_museum' => 2,
            'nama_kategori' => 'Umum'
        ]);
    }
}
