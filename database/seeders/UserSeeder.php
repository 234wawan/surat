<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin PDAM',             'email' => 'admin@pdam.com',          'password' => 'admin123',  'role' => 'admin', 'jabatan_id' => null],
            ['name' => 'Rina Marlina',           'email' => 'ketua_spi@pdam.com',       'password' => 'password',  'role' => 'staf',  'jabatan_id' => 1],
            ['name' => 'Budi Santoso',           'email' => 'kabag_keuangan@pdam.com',  'password' => 'password',  'role' => 'kabag', 'jabatan_id' => 2],
            ['name' => 'Agus Wijaya',            'email' => 'kabag_produksi@pdam.com',  'password' => 'password',  'role' => 'kabag', 'jabatan_id' => 3],
            ['name' => 'Dewi Lestari',           'email' => 'kabag_perencanaan@pdam.com', 'password' => 'password', 'role' => 'kabag', 'jabatan_id' => 4],
            ['name' => 'Hendra Gunawan',         'email' => 'kepala_cabang@pdam.com',   'password' => 'password',  'role' => 'kabag', 'jabatan_id' => 5],
            ['name' => 'Fitriani',               'email' => 'kasubag_hukum@pdam.com',   'password' => 'password',  'role' => 'staf',  'jabatan_id' => 6],
            ['name' => 'Drs. H. Sutrisno',       'email' => 'direksi@pdam.com',         'password' => 'password',  'role' => 'admin', 'jabatan_id' => 7],
        ];

        foreach ($users as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'jabatan_id' => $data['jabatan_id'],
            ]);
        }
    }
}
