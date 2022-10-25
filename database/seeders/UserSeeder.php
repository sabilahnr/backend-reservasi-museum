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
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');
       
        $admin = User::create([
            'name' => 'Admin Samuel',
            'email' => 'adminsamuel@role.test',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');

        $superadmin = User::create([
            'name' => 'Super Admin Role',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('12345678')
        ]);
        $superadmin->assignRole('superadmin');

        $superadmin = User::create([
            'name' => 'Udin Super Admin Role',
            'email' => 'superadminudin@role.test',
            'password' => bcrypt('12345678')
        ]);

        $superadmin->assignRole('superadmin');
    }
}
