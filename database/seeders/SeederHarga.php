<?php

namespace Database\Seeders;

use App\Models\harga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederHarga extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('harga')->insert([
        //     'id' => 1,
        //     'id_kategori' => 1,
        //     'hari_biasa' => 7500,
        //     'hari_libur' => 10000
        // ]);

        harga::create([
            'id' => 1,
            'id_museum' => 1,
            'id_kategori' => 1,
            'hari_biasa' => 7500,
            'hari_libur' => 10000
        ]);
        harga::create([
            'id' => 2,
            'id_museum' => 1,
            'id_kategori' => 2,
            'hari_biasa' => 5000,
            'hari_libur' => 7500
        ]);
        harga::create([
            'id' => 3,
            'id_museum' => 1,
            'id_kategori' => 3,
            'hari_biasa' => 5000,
            'hari_libur' => 4000
        ]);
        harga::create([
            'id' => 4,
            'id_museum' => 1,
            'id_kategori' => 4,
            'hari_biasa' => 5000,
            'hari_libur' => 7500
        ]);
        harga::create([
            'id' => 5,
            'id_museum' => 1,
            'id_kategori' => 5,
            'hari_biasa' => 4000,
            'hari_libur' => 5000
        ]);
        harga::create([
            'id' => 6,
            'id_museum' => 1,
            'id_kategori' => 6,
            'hari_biasa' => 15000,
            'hari_libur' => 20000
        ]);
        harga::create([
            'id' => 7,
            'id_museum' => 2,
            'id_kategori' => 7,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 8,
            'id_museum' => 2,
            'id_kategori' => 8,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 9,
            'id_museum' => 2,
            'id_kategori' => 9,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 10,
            'id_museum' => 2,
            'id_kategori' => 10,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 11,
            'id_museum' => 2,
            'id_kategori' => 11,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 12,
            'id_museum' => 2,
            'id_kategori' => 12,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 13,
            'id_museum' => 2,
            'id_kategori' => 13,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
        harga::create([
            'id' => 14,
            'id_museum' => 2,
            'id_kategori' => 14,
            'hari_biasa' => 0,
            'hari_libur' => 0
        ]);
    }
}
