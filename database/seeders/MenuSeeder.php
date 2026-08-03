<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuRole;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // Menu Utama
            ['name' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'route' => 'dashboard', 'order' => 0, 'section' => 'Menu Utama', 'roles' => ['admin', 'staf', 'kabag']],
            ['name' => 'Surat Masuk', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4', 'route' => 'surat-masuk.index', 'order' => 1, 'section' => 'Menu Utama', 'roles' => ['admin', 'staf', 'kabag']],
            ['name' => 'Surat Keluar', 'icon' => 'M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10.07l6.75 4.5M21 10.07l-6.75 4.5', 'route' => 'surat-keluar.index', 'order' => 2, 'section' => 'Menu Utama', 'roles' => ['admin', 'staf', 'kabag']],
            ['name' => 'Disposisi', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'route' => 'disposisi.index', 'order' => 3, 'section' => 'Menu Utama', 'roles' => ['admin', 'staf', 'kabag']],

            // Administrasi (hanya admin)
            ['name' => 'Master Surat', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'route' => 'master-surat.index', 'order' => 0, 'section' => 'Administrasi', 'roles' => ['admin']],
            ['name' => 'Tambah User', 'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z', 'route' => 'register', 'order' => 1, 'section' => 'Administrasi', 'roles' => ['admin']],
            ['name' => 'Jabatan', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'route' => 'jabatan.index', 'order' => 2, 'section' => 'Administrasi', 'roles' => ['admin']],
            ['name' => 'Menu Management', 'icon' => 'M4 6h16M4 12h16M4 18h16', 'route' => 'menu.index', 'order' => 3, 'section' => 'Administrasi', 'roles' => ['admin']],
            ['name' => 'Role Management', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'route' => 'role.index', 'order' => 4, 'section' => 'Administrasi', 'roles' => ['admin']],
        ];

        foreach ($menus as $item) {
            $roles = $item['roles'];
            unset($item['roles']);

            $menu = Menu::create($item);
            foreach ($roles as $role) {
                MenuRole::create(['menu_id' => $menu->id, 'role' => $role]);
            }
        }
    }
}
