<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Detail Master Surat</span>
            <a href="{{ route('master-surat.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors shadow-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-5">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kode</p>
                    <p class="mt-1"><span class="inline-flex items-center px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-md font-mono text-sm font-semibold">{{ $masterSurat->kode }}</span></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $masterSurat->nama }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pola Nomor</p>
                    <p class="mt-1 font-mono text-sm text-gray-700 dark:text-gray-300">{{ $masterSurat->pola_nomor ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keterangan</p>
                    <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $masterSurat->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Surat Keluar ({{ $masterSurat->suratKeluar->count() }})</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">No Surat</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Perihal</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Tujuan</th>
                            <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($masterSurat->suratKeluar as $sk)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-5 py-4 whitespace-nowrap font-mono text-sm text-gray-900 dark:text-white">{{ $sk->no_surat }}</td>
                                <td class="px-5 py-4 text-gray-700 dark:text-gray-300 max-w-xs truncate">{{ $sk->perihal }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $sk->tujuan }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-center text-gray-600 dark:text-gray-400">{{ $sk->tanggal_surat->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">Belum ada surat keluar menggunakan master surat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
