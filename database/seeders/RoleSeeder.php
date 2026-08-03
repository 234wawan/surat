<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator dengan akses penuh ke semua fitur sistem.'],
            ['name' => 'Staf', 'slug' => 'staf', 'description' => 'Staf yang dapat mengelola surat masuk, surat keluar, dan disposisi.'],
            ['name' => 'Kabag', 'slug' => 'kabag', 'description' => 'Kepala Bagian yang dapat melihat semua surat dan membuat disposisi.'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
