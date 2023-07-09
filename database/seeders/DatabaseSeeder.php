<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\harga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(museum::class);
        $this->call(kategori::class);
        // $this->call(SeederHarga::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SeederFAQ::class);
        $this->call(PengunjungSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(PanduanSeeder::class);
    }
}
