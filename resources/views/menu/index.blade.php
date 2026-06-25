<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Menu Management</span>
            <a href="{{ route('menu.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Menu
            </a>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Induk</th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Route / URL</th>
                        <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Aktif</th>
                        <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Role</th>
                        <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Urutan</th>
                        <th class="px-5 py-4 text-right font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    @if($menu->icon)
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    @endif
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $menu->name }}</span>
                                </div>
                                @if($menu->section)
                                    <span class="text-xs text-gray-500">({{ $menu->section }})</span>
                                @endif
                                @if($menu->children->count() > 0)
                                    <div class="mt-2 space-y-1">
                                        @foreach($menu->children as $child)
                                            <div class="flex items-center gap-2 pl-4 text-xs text-gray-500">
                                                <span>↳ {{ $child->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-gray-500">{{ $menu->parent->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-xs font-mono text-gray-500">{{ $menu->route ?: $menu->url ?: '-' }}</td>
                            <td class="px-5 py-4 text-center">
                                @if($menu->active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Ya</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">Tidak</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex justify-center gap-1">
                                    @foreach($menu->roles as $mr)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">{{ $mr->role }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center text-gray-500">{{ $menu->order }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('menu.edit', $menu) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors">Edit</a>
                                    <form action="{{ route('menu.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="text-gray-500 dark:text-gray-400">Belum ada menu. Silakan tambah menu baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
