<?php

namespace Database\Seeders;

use App\Models\Panduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Panduan::create([
            'id' => 1,
            'panduan_name' =>'<p>Panduan Tiket dapat di lihat melalui</p>',
            'panduan_name_en' =>'<p>How to Reserve this ticket....</p>',
        ]);
        // Panduan::create([
        //     'id' => 2,
        //     'panduan_name' =>'https://source.unsplash.com/random',
        // ]);
    }
}
