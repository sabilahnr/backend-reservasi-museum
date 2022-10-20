<?php

namespace Database\Seeders;

use App\Models\museum as ModelsMuseum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class museum extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('museum')->insert([
        //     'id' => 1,
        //     'nama_museum' => 'museum keris nusantara',
        // ]);

        ModelsMuseum::create([
            'id' => 1,
            'nama_museum' => 'Museum Keris Nusantara',
        ]);
        ModelsMuseum::create([
            'id' => 2,
            'nama_museum' => 'Museum Radya Pustaka',
        ]);
    }
}
