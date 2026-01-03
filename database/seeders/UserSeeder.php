<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $datas = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'username' => 'admin', 'email_verified_at' => now(), 'role' => 'admin'],
            ['name' => 'Dokter', 'email' => 'dokter@gmail.com', 'username' => 'dokter', 'email_verified_at' => now(), 'role' => 'dokter'],
            ['name' => 'Petugas Pendaftaran', 'email' => 'petugas@gmail.com', 'username' => 'petugas', 'email_verified_at' => now(), 'role' => 'petugas-pendaftaran'],
            ['name' => 'Apoteker', 'email' => 'apoteker@gmail.com', 'username' => 'apoteker', 'email_verified_at' => now(), 'role' => 'apoteker'],
            ['name' => 'Pasien', 'email' => 'pasien@gmail.com', 'username' => 'pasien', 'email_verified_at' => now(), 'role' => 'pasien'],
        ];

        foreach ($datas as $data) {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $password,
                'email_verified_at' => $data['email_verified_at'],
            ]);

            $role = Role::findByName($data['role'], 'web');
            $user->assignRole($role);

            // if ($data['role'] == 'user') {
            //     UserDetail::create([
            //         'user_id' => $user->id,
            //     ]);
            // } else {
            //     AdminDetail::create([
            //         'admin_id' => $user->id,
            //     ]);
            // }
        }
    }
}
