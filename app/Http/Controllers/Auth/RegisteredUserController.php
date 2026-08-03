<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $roles = Role::pluck('name', 'slug')->toArray();
        return view('auth.register', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validRoles = Role::pluck('slug')->toArray();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:'.implode(',', $validRoles)],
            'jabatan_id' => ['nullable', 'exists:jabatan,id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jabatan_id' => $request->jabatan_id,
        ]);

        return redirect(route('dashboard'))->with('success', 'User berhasil ditambahkan.');
    }
}
