<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'no_hp' => "08998089724",
            'jenis_kelamin' => "Laki-laki",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        $user->assignRole('Admin');

        $kasir = User::create([
            'name' => 'Kasir',
            'no_hp' => "08223008246",
            'jenis_kelamin' => "Laki-laki",
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123')
        ]);
        $kasir->assignRole('Kasir');

        $dapur = User::create([
            'name' => 'Dapur',
            'no_hp' => "08588089205",
            'jenis_kelamin' => "Laki-laki",
            'email' => 'dapur@gmail.com',
            'password' => Hash::make('dapur123')
        ]);
        $dapur->assignRole('Dapur');
    }
}