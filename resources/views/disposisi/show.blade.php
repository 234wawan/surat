<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Detail Disposisi</span>
            <div class="flex gap-2">
                <a href="{{ route('disposisi.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Surat</h3>
                @if($disposisi->status === 'belum')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">Belum Dibaca</span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Sudah Dibaca</span>
                @endif
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No Surat</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $disposisi->suratMasuk->no_surat }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pengirim Surat</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $disposisi->suratMasuk->pengirim }}</dd>
                        </div>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Perihal Surat</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $disposisi->suratMasuk->perihal }}</dd>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Disposisi</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dari</dt>
                                <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $disposisi->pengirim->name }}<br><span class="text-xs text-gray-500">{{ $disposisi->pengirim->jabatan->nama ?? '' }}</span></dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kepada Utama</dt>
                                <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $disposisi->penerima->name }}<br><span class="text-xs text-gray-500">{{ $disposisi->penerima->jabatan->nama ?? '' }}</span></dd>
                            </div>
                        </div>
                        @if($disposisi->penerimaLainnya->count() > 0)
                            <div class="mt-3">
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Penerima Lainnya</dt>
                                <dd class="mt-1 flex flex-wrap gap-2">
                                    @foreach($disposisi->penerimaLainnya as $p)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300">{{ $p->name }} <span class="text-xs text-indigo-400">({{ $p->jabatan->nama ?? '' }})</span></span>
                                    @endforeach
                                </dd>
                            </div>
                        @endif
                    </div>

                    @if($disposisi->instruksi_jenis)
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Instruksi</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">{{ $disposisi->instruksi_jenis }}</span>
                            </dd>
                        </div>
                    @endif

                    @if($disposisi->instruksi)
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Instruksi Tambahan</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">{{ $disposisi->instruksi }}</dd>
                        </div>
                    @endif

                    @if($disposisi->catatan_direksi)
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Catatan / Instruksi Direksi</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300 bg-amber-50 dark:bg-amber-900/20 rounded-lg p-3 border border-amber-200 dark:border-amber-800">{{ $disposisi->catatan_direksi }}</dd>
                        </div>
                    @endif

                    @if($disposisi->catatan)
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Catatan</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">{{ $disposisi->catatan }}</dd>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Batas Waktu</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $disposisi->batas_waktu ? $disposisi->batas_waktu->format('d F Y') : '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal Disposisi</dt>
                            <dd class="mt-1 text-sm text-gray-700 dark:text-gray-300">{{ $disposisi->created_at->format('d M Y H:i') }}</dd>
                        </div>
                    </div>
                </dl>
            </div>
        </div>

        @if($disposisi->parent)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Disposisi Sebelumnya</h3>
                </div>
                <div class="p-6">
                    <div class="relative pl-8">
                        <div class="absolute left-2.5 top-1 w-2 h-2 bg-indigo-500 rounded-full ring-4 ring-indigo-100 dark:ring-indigo-900/50"></div>
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $disposisi->parent->pengirim->name }} ({{ $disposisi->parent->pengirim->jabatan->nama ?? '?' }}) → {{ $disposisi->parent->penerima->name }} ({{ $disposisi->parent->penerima->jabatan->nama ?? '?' }})</span>
                            </div>
                            @if($disposisi->parent->instruksi_jenis)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">{{ $disposisi->parent->instruksi_jenis }}</span>
                            @endif
                            @if($disposisi->parent->catatan_direksi)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2"><span class="font-medium">Catatan Direksi:</span> {{ $disposisi->parent->catatan_direksi }}</p>
                            @endif
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $disposisi->parent->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($disposisi->children->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Disposisi Lanjutan</h3>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($disposisi->children as $child)
                        <div class="relative pl-8">
                            <div class="absolute left-2.5 top-1 w-2 h-2 bg-emerald-500 rounded-full ring-4 ring-emerald-100 dark:ring-emerald-900/50"></div>
                            <div class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $child->pengirim->name }} ({{ $child->pengirim->jabatan->nama ?? '?' }}) → {{ $child->penerima->name }} ({{ $child->penerima->jabatan->nama ?? '?' }})</span>
                                    @if($child->penerimaLainnya->count() > 0)
                                        <span class="text-xs text-gray-500">+{{ $child->penerimaLainnya->count() }} lainnya</span>
                                    @endif
                                </div>
                                @if($child->instruksi_jenis)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">{{ $child->instruksi_jenis }}</span>
                                @endif
                                @if($child->catatan_direksi)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2"><span class="font-medium">Catatan:</span> {{ Str::limit($child->catatan_direksi, 100) }}</p>
                                @endif
                                <div class="flex items-center gap-2 mt-2">
                                    <a href="{{ route('disposisi.show', $child) }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Detail</a>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $child->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Buat Disposisi Lanjutan</h3>
            <form action="{{ route('disposisi.store-lanjutan', $disposisi) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-input-label value="Disposisi Kepada" />
                    <div class="mt-2 space-y-2">
                        @foreach($users->groupBy(function($u) { return $u->jabatan->nama ?? 'Lainnya'; }) as $group => $groupUsers)
                            <div class="mb-2">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">{{ $group }}</p>
                                <div class="space-y-1 pl-2">
                                    @foreach($groupUsers as $user)
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="penerima_lainnya[]" value="{{ $user->id }}"
                                                class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900 lanjutan-checkbox"
                                                data-user="{{ $user->id }}">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $user->name }} <span class="text-xs text-gray-500">({{ $user->jabatan->nama ?? 'Tanpa Jabatan' }})</span></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="kepada" id="kepada_lanjutan" value="">
                </div>

                <div class="mb-4">
                    <x-input-label value="Instruksi" />
                    <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($instruksiOptions as $option)
                            <label class="flex items-center gap-2 p-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <input type="radio" name="instruksi_jenis" value="{{ $option }}"
                                    class="border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <x-input-label for="catatan_direksi_lanjutan" value="Catatan / Instruksi" />
                    <textarea id="catatan_direksi_lanjutan" name="catatan_direksi" rows="2" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm"></textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="instruksi_lanjutan" value="Instruksi Tambahan" />
                    <textarea id="instruksi_lanjutan" name="instruksi" rows="2" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm"></textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="catatan_lanjutan" value="Catatan" />
                    <textarea id="catatan_lanjutan" name="catatan" rows="2" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm"></textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="batas_waktu_lanjutan" value="Batas Waktu" />
                    <x-text-input id="batas_waktu_lanjutan" name="batas_waktu" type="date" class="mt-1.5 block w-full" />
                </div>

                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    Kirim Disposisi Lanjutan
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.lanjutan-checkbox').forEach(cb => {
                cb.addEventListener('change', function() {
                    const checked = document.querySelectorAll('.lanjutan-checkbox:checked');
                    document.getElementById('kepada_lanjutan').value = checked.length > 0 ? checked[0].dataset.user : '';
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
