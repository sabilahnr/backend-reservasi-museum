<?php

namespace Database\Seeders;
Use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'status' => '1',
            'password' => bcrypt('Admin123!')
        ]);

        $admin->assignRole('admin');
       
        $admin = User::create([
            'name' => 'Admin Samuel',
            'status' => '1',
            'email' => 'adminsamuel@role.test',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');

        $superadmin = User::create([
            'name' => 'Super Admin Role',
            'status' => '1',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('Superadmin123!')
        ]);
        $superadmin->assignRole('superadmin');

        $superadmin = User::create([
            'name' => 'Udin Super Admin Role',
            'status' => '1',
            'email' => 'superadminudin@role.test',
            'password' => bcrypt('12345678')
        ]);

        $superadmin->assignRole('superadmin');

        $kepalauptmuseum = User::create([
            'name' => 'Pak Luthfi',
            'status' => '1',
            'email' => 'kepalauptmuseum@role.test',
            'password' => bcrypt('Kepalauptmuseum123!')
        ]);

        $kepalauptmuseum->assignRole('kepalauptmuseum');
    }
}
