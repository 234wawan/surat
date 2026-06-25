<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>Detail Surat Keluar</span>
            <a href="{{ route('surat-keluar.print', $suratKeluar) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Surat</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No Agenda</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md font-mono text-xs">{{ $suratKeluar->no_agenda }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No Surat</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $suratKeluar->no_surat }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jenis Surat</dt>
                        <dd class="mt-1">
                            @if($suratKeluar->masterSurat)
                                <span class="inline-flex items-center px-2.5 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-md text-xs font-semibold">{{ $suratKeluar->masterSurat->kode }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">{{ $suratKeluar->masterSurat->nama }}</span>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal Surat</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratKeluar->tanggal_surat->format('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tujuan</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratKeluar->tujuan }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Perihal</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $suratKeluar->perihal }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Lampiran</dt>
                        <dd class="mt-1">
                            @if($suratKeluar->lampiran)
                                <a href="{{ asset('storage/' . $suratKeluar->lampiran) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Lihat PDF
                                </a>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Diinput Oleh</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratKeluar->user->name }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Isi Ringkas</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">{{ $suratKeluar->isi_ringkas ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
