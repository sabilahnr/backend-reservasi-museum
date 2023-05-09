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
        ]);
        harga::create([
            'id' => 2,
        ]);
        harga::create([
            'id' => 3,
        ]);
        harga::create([
            'id' => 4,
        ]);
        harga::create([
            'id' => 5,
        ]);
        harga::create([
            'id' => 6,
        ]);
        harga::create([
            'id' => 7,
        ]);
        harga::create([
            'id' => 8,
        ]);
        harga::create([
            'id' => 9,
        ]);
        harga::create([
            'id' => 10,
        ]);
        harga::create([
            'id' => 11,
        ]);
        harga::create([
            'id' => 12,
        ]);
        harga::create([
            'id' => 13,
        ]);
        harga::create([
            'id' => 14,
        ]);
    }
}
