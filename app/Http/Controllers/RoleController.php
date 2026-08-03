<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->latest()->get();
        $menus = Menu::with('children')->root()->ordered()->get();
        return view('role.index', compact('roles', 'menus'));
    }

    public function create()
    {
        $menus = Menu::with('children')->root()->ordered()->get();
        return view('role.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
            'description' => 'nullable|string',
            'menus' => 'nullable|array',
            'menus.*' => 'integer|exists:menus,id',
        ]);

        $role = Role::create($validated);

        if ($request->has('menus')) {
            foreach ($request->menus as $menuId) {
                MenuRole::create(['menu_id' => $menuId, 'role' => $role->slug]);
            }
        }

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function show(Role $role)
    {
        $role->load('users.jabatan');
        $menus = Menu::with('children')->root()->ordered()->get();
        $roleMenus = $role->menus->pluck('menu_id')->toArray();
        return view('role.show', compact('role', 'menus', 'roleMenus'));
    }

    public function edit(Role $role)
    {
        $role->load('menus');
        $menus = Menu::with('children')->root()->ordered()->get();
        $roleMenus = $role->menus->pluck('menu_id')->toArray();
        return view('role.edit', compact('role', 'menus', 'roleMenus'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
            'menus' => 'nullable|array',
            'menus.*' => 'integer|exists:menus,id',
        ]);

        $oldSlug = $role->slug;
        $role->update($validated);

        MenuRole::where('role', $oldSlug)->delete();
        if ($request->has('menus')) {
            foreach ($request->menus as $menuId) {
                MenuRole::create(['menu_id' => $menuId, 'role' => $role->slug]);
            }
        }

        if ($oldSlug !== $role->slug) {
            \App\Models\User::where('role', $oldSlug)->update(['role' => $role->slug]);
        }

        return redirect()->route('role.index')->with('success', 'Role berhasil diupdate.');
    }

    public function destroy(Role $role)
    {
        MenuRole::where('role', $role->slug)->delete();
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus.');
    }

    public function getMenus(Role $role)
    {
        $menuIds = $role->menus->pluck('menu_id')->toArray();
        return response()->json(['menu_ids' => $menuIds]);
    }

    public function toggleMenu(Request $request, Role $role)
    {
        $request->validate([
            'menu_id' => 'required|integer|exists:menus,id',
        ]);

        $menuId = $request->menu_id;
        $exists = MenuRole::where('menu_id', $menuId)->where('role', $role->slug)->exists();

        if ($exists) {
            MenuRole::where('menu_id', $menuId)->where('role', $role->slug)->delete();
        } else {
            MenuRole::create(['menu_id' => $menuId, 'role' => $role->slug]);
        }

        $count = MenuRole::where('role', $role->slug)->count();

        return response()->json([
            'success' => true,
            'action' => $exists ? 'removed' : 'added',
            'menu_count' => $count,
        ]);
    }

    public function toggleMenusBulk(Request $request, Role $role)
    {
        $request->validate([
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'integer|exists:menus,id',
            'active' => 'required|boolean',
        ]);

        $menuIds = $request->menu_ids;
        $active = $request->active;

        if ($active) {
            foreach ($menuIds as $menuId) {
                MenuRole::firstOrCreate(['menu_id' => $menuId, 'role' => $role->slug]);
            }
        } else {
            MenuRole::where('role', $role->slug)->whereIn('menu_id', $menuIds)->delete();
        }

        $count = MenuRole::where('role', $role->slug)->count();

        return response()->json([
            'success' => true,
            'action' => $active ? 'added' : 'removed',
            'menu_count' => $count,
        ]);
    }
}
