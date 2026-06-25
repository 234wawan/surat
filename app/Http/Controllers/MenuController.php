<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuRole;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('parent', 'children')->latest()->get();
        return view('menu.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        $menu->load('parent', 'children', 'roles');
        return view('menu.show', compact('menu'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        $roles = ['admin', 'staf', 'kabag'];
        return view('menu.create', compact('parentMenus', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_param' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'section' => 'nullable|string|max:255',
            'active' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'string|in:admin,staf,kabag',
        ]);

        $menu = Menu::create($validated);

        if ($request->has('roles')) {
            foreach ($request->roles as $role) {
                MenuRole::create(['menu_id' => $menu->id, 'role' => $role]);
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $menu->load('roles');
        $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        $roles = ['admin', 'staf', 'kabag'];
        return view('menu.edit', compact('menu', 'parentMenus', 'roles'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_param' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'section' => 'nullable|string|max:255',
            'active' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'string|in:admin,staf,kabag',
        ]);

        $menu->update($validated);

        MenuRole::where('menu_id', $menu->id)->delete();
        if ($request->has('roles')) {
            foreach ($request->roles as $role) {
                MenuRole::create(['menu_id' => $menu->id, 'role' => $role]);
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
