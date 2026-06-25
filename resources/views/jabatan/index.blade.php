<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Jabatan</span>
            <a href="{{ route('jabatan.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Jabatan
            </a>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Nama Jabatan</th>
                        <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Keterangan</th>
                        <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Jumlah User</th>
                        <th class="px-5 py-4 text-right font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($jabatan as $j)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-5 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">{{ $j->nama }}</td>
                            <td class="px-5 py-4 text-gray-600 dark:text-gray-400">{{ $j->keterangan ?? '-' }}</td>
                            <td class="px-5 py-4 text-center text-gray-700 dark:text-gray-300">{{ $j->users_count }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('jabatan.edit', $j) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors">Edit</a>
                                    <form action="{{ route('jabatan.destroy', $j) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center">
                                <p class="text-gray-500 dark:text-gray-400">Belum ada jabatan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
