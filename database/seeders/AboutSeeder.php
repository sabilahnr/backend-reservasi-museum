<?php

namespace Database\Seeders;

use App\Models\about;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        about::create([
            'id' => 1,
            'about' =>'Apakah didalam museum diperbolehkan makan atau minumleddhsiacunx,ksdaljo',
        ]);
    }
}
