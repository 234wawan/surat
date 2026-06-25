<x-app-layout>
    <x-slot name="header">Buat Disposisi</x-slot>

    <div class="max-w-4xl mx-auto space-y-5">
        @if($parentDisposisi)
        <div class="bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-400 rounded-r-xl shadow-sm p-4">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                <p class="text-sm text-amber-800 dark:text-amber-200">
                    <strong>Disposisi Lanjutan</strong> dari <strong>{{ $parentDisposisi->pengirim->name }}</strong>
                    @if($parentDisposisi->catatan_direksi)
                        — <span class="italic">{{ $parentDisposisi->catatan_direksi }}</span>
                    @endif
                </p>
            </div>
        </div>
        @endif
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <div class="grid grid-cols-2 gap-x-6 gap-y-1">
                    <div>No Surat: <strong class="text-gray-900 dark:text-white">{{ $suratMasuk->no_surat }}</strong></div>
                    <div>Pengirim: <strong class="text-gray-900 dark:text-white">{{ $suratMasuk->pengirim }}</strong></div>
                    <div>Tanggal Surat: <strong class="text-gray-900 dark:text-white">{{ $suratMasuk->tanggal_surat->format('d/m/Y') }}</strong></div>
                    <div>Tanggal Terima: <strong class="text-gray-900 dark:text-white">{{ $suratMasuk->tanggal_terima->format('d/m/Y') }}</strong></div>
                    <div class="col-span-2">Perihal: <strong class="text-gray-900 dark:text-white">{{ $suratMasuk->perihal }}</strong></div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5 text-center">LEMBAR DISPOSISI</h3>

            <form action="{{ route('disposisi.store', $suratMasuk) }}" method="POST">
                @csrf
                @if(request('parent_id'))
                    <input type="hidden" name="parent_id" value="{{ request('parent_id') }}">
                @endif

                <div class="mb-6">
                    <x-input-label value="Disposisi Kepada" />
                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach($jabatanList as $jabatan)
                            <label class="flex items-center gap-2 p-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <input type="checkbox" name="disposisi_jabatan[]" value="{{ $jabatan->id }}"
                                    class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900 disposisi-jabatan"
                                    data-jabatan="{{ $jabatan->id }}">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $jabatan->nama }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('disposisi_jabatan')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label value="Instruksi" />
                    <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($instruksiOptions as $option)
                            <label class="flex items-center gap-2 p-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <input type="radio" name="instruksi_jenis" value="{{ $option }}"
                                    class="border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900"
                                    {{ old('instruksi_jenis', 'Diteruskan') == $option ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('instruksi_jenis')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <x-input-label for="catatan_direksi" value="Catatan / Instruksi" />
                    <textarea id="catatan_direksi" name="catatan_direksi" rows="3" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm" placeholder="Catatan / instruksi...">{{ old('catatan_direksi') }}</textarea>
                    <x-input-error :messages="$errors->get('catatan_direksi')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="batas_waktu" value="Batas Waktu" />
                    <x-text-input id="batas_waktu" name="batas_waktu" type="date" class="mt-1.5 block w-full" :value="old('batas_waktu')" />
                    <x-input-error :messages="$errors->get('batas_waktu')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Disposisi
                    </button>
                    <a href="{{ route('surat-masuk.show', $suratMasuk) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
