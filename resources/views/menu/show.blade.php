<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Detail Menu</span>
            <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors shadow-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-5">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Menu</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $menu->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menu Induk</p>
                    <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $menu->parent->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Route / URL</p>
                    <p class="mt-1 font-mono text-sm text-gray-700 dark:text-gray-300">{{ $menu->route ?: $menu->url ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aktif</p>
                    <p class="mt-1">@if($menu->active)<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Ya</span>@else<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">Tidak</span>@endif</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Section</p>
                    <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $menu->section ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Urutan</p>
                    <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $menu->order }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Role yang Dapat Mengakses</h3>
            </div>
            <div class="px-5 py-4">
                <div class="flex gap-2">
                    @forelse($menu->roles as $mr)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">{{ ucfirst($mr->role) }}</span>
                    @empty
                        <span class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada role</span>
                    @endforelse
                </div>
            </div>
        </div>

        @if($menu->children->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Sub Menu ({{ $menu->children->count() }})</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Nama</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Route</th>
                            <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Urutan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($menu->children as $child)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-5 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">{{ $child->name }}</td>
                                <td class="px-5 py-4 whitespace-nowrap font-mono text-xs text-gray-600 dark:text-gray-400">{{ $child->route ?: $child->url ?: '-' }}</td>
                                <td class="px-5 py-4 text-center text-gray-600 dark:text-gray-400">{{ $child->order }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
