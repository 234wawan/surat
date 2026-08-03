<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Detail Role</span>
            <div class="flex items-center gap-2">
                <a href="{{ route('role.edit', $role) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">Edit</a>
                <a href="{{ route('role.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors shadow-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-5">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Role</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $role->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Slug</p>
                    <p class="mt-1"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300">{{ $role->slug }}</span></p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</p>
                    <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $role->description ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Menu yang Dapat Diakses</h3>
            </div>
            <div class="p-5 space-y-3">
                @foreach($menus as $menu)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-700/50">
                            <div class="flex items-center gap-3">
                                @if(in_array($menu->id, $roleMenus))
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-600">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-gray-300 dark:bg-gray-600">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </span>
                                @endif
                                <span class="text-sm font-semibold {{ in_array($menu->id, $roleMenus) ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-500' }}">{{ $menu->name }}</span>
                            </div>
                            @if($menu->section)
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $menu->section }}</span>
                            @endif
                        </div>

                        @if($menu->children->count() > 0)
                            <div class="px-4 py-2 space-y-1 bg-white dark:bg-gray-800">
                                @foreach($menu->children as $child)
                                    <div class="flex items-center gap-3 py-1.5">
                                        @if(in_array($child->id, $roleMenus))
                                            <span class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-emerald-500">
                                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-gray-200 dark:bg-gray-700">
                                                <svg class="w-2.5 h-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </span>
                                        @endif
                                        <span class="text-sm {{ in_array($child->id, $roleMenus) ? 'text-gray-700 dark:text-gray-300' : 'text-gray-400 dark:text-gray-500' }}">{{ $child->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">User dengan Role Ini ({{ $role->users->count() }})</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Nama</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Email</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($role->users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-5 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-gray-500">{{ $user->email }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-gray-500">{{ $user->jabatan->nama ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada user dengan role ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
