<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Detail Surat Masuk</span>
            @can('crud-disposisi')
            <a href="{{ route('disposisi.create', $suratMasuk) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Disposisi
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Surat</h3>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No Agenda</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md font-mono text-xs">{{ $suratMasuk->no_agenda }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No Surat</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $suratMasuk->no_surat }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal Surat</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->tanggal_surat->format('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal Terima</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->tanggal_terima->format('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jam Terima</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->jam_terima ? \Carbon\Carbon::parse($suratMasuk->jam_terima)->format('H:i') : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pengirim</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->pengirim }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Lampiran</dt>
                        <dd class="mt-1">
                            @if($suratMasuk->lampiran)
                                <a href="{{ asset('storage/' . $suratMasuk->lampiran) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Lihat PDF
                                </a>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Perihal</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $suratMasuk->perihal }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keterangan</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->keterangan ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Diinput Oleh</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $suratMasuk->user->name }}<br><span class="text-xs text-gray-500">{{ $suratMasuk->user->jabatan->nama ?? '' }}</span></dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Isi Ringkas</dt>
                        <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">{{ $suratMasuk->isi_ringkas ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Riwayat Disposisi</h3>
            </div>
            <div class="p-6">
                @forelse($disposisi as $d)
                    <div class="relative pl-8 pb-6 last:pb-0">
                        <div class="absolute left-2.5 top-1 w-2 h-2 bg-indigo-500 rounded-full ring-4 ring-indigo-100 dark:ring-indigo-900/50"></div>
                        <div class="absolute left-3.5 top-4 bottom-0 w-0.5 bg-gray-200 dark:bg-gray-700 last:hidden"></div>
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $d->pengirim->name }}<span class="text-xs text-gray-500"> ({{ $d->pengirim->jabatan->nama ?? '' }})</span>
                                    @if($d->penerima)
                                        → {{ $d->penerima->name }}<span class="text-xs text-gray-500"> ({{ $d->penerima->jabatan->nama ?? '' }})</span>
                                    @endif
                                    @if($d->penerimaLainnya->count())
                                        @foreach($d->penerimaLainnya as $pl)
                                            → {{ $pl->name }}<span class="text-xs text-gray-500"> ({{ $pl->jabatan->nama ?? '' }})</span>
                                        @endforeach
                                    @endif
                                </span>
                                @if($d->status === 'belum')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">Belum Dibaca</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Sudah Dibaca</span>
                                @endif
                            </div>
                            @if($d->instruksi_jenis)<p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-medium">Instruksi:</span> {{ $d->instruksi_jenis }}</p>@endif
                            @if($d->catatan_direksi)<p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-medium">Catatan Direksi:</span> {{ $d->catatan_direksi }}</p>@endif
                            @if($d->instruksi)<p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-medium">Instruksi Tambahan:</span> {{ $d->instruksi }}</p>@endif
                            @if($d->catatan)<p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-medium">Catatan:</span> {{ $d->catatan }}</p>@endif
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $d->created_at->format('d M Y H:i') }}</p>
                                @can('crud-disposisi')
                                @if(Auth::id() != $d->dari)
                                <a href="{{ route('disposisi.create', ['suratMasuk' => $suratMasuk, 'parent_id' => $d->id]) }}" class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    Disposisi Lanjutan
                                </a>
                                @endif
                                @endcan
                            </div>
                        </div>

                        @foreach($d->children as $child)
                        <div class="relative pl-8 mt-3">
                            <div class="absolute left-2.5 top-1 w-2 h-2 bg-amber-500 rounded-full ring-4 ring-amber-100 dark:ring-amber-900/50"></div>
                            <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-4 border-l-2 border-amber-400">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        Disposisi Lanjutan — {{ $child->pengirim->name }}<span class="text-xs text-gray-500"> ({{ $child->pengirim->jabatan->nama ?? '' }})</span>
                                        @if($child->penerima)
                                            → {{ $child->penerima->name }}<span class="text-xs text-gray-500"> ({{ $child->penerima->jabatan->nama ?? '' }})</span>
                                        @endif
                                        @if($child->penerimaLainnya->count())
                                            @foreach($child->penerimaLainnya as $pl)
                                                → {{ $pl->name }}<span class="text-xs text-gray-500"> ({{ $pl->jabatan->nama ?? '' }})</span>
                                            @endforeach
                                        @endif
                                    </span>
                                    @if($child->status === 'belum')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">Belum Dibaca</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Sudah Dibaca</span>
                                    @endif
                                </div>
                                @if($child->catatan)<p class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ $child->catatan }}"</p>@endif
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $child->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada disposisi untuk surat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
