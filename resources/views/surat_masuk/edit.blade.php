<x-app-layout>
    <x-slot name="header">Edit Surat Masuk</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('surat-masuk.update', $suratMasuk) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="no_agenda" value="No Agenda" />
                        <x-text-input id="no_agenda" name="no_agenda" type="text" class="mt-1.5 block w-full" :value="old('no_agenda', $suratMasuk->no_agenda)" required />
                        <x-input-error :messages="$errors->get('no_agenda')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="no_surat" value="No Surat" />
                        <x-text-input id="no_surat" name="no_surat" type="text" class="mt-1.5 block w-full" :value="old('no_surat', $suratMasuk->no_surat)" required />
                        <x-input-error :messages="$errors->get('no_surat')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="pengirim" value="Pengirim / Instansi" />
                        <x-text-input id="pengirim" name="pengirim" type="text" class="mt-1.5 block w-full" :value="old('pengirim', $suratMasuk->pengirim)" required />
                        <x-input-error :messages="$errors->get('pengirim')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="perihal" value="Perihal" />
                        <x-text-input id="perihal" name="perihal" type="text" class="mt-1.5 block w-full" :value="old('perihal', $suratMasuk->perihal)" required />
                        <x-input-error :messages="$errors->get('perihal')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="tanggal_surat" value="Tanggal Surat" />
                        <x-text-input id="tanggal_surat" name="tanggal_surat" type="date" class="mt-1.5 block w-full" :value="old('tanggal_surat', $suratMasuk->tanggal_surat->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('tanggal_surat')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="tanggal_terima" value="Tanggal Terima" />
                        <x-text-input id="tanggal_terima" name="tanggal_terima" type="date" class="mt-1.5 block w-full" :value="old('tanggal_terima', $suratMasuk->tanggal_terima->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('tanggal_terima')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="jam_terima" value="Jam Terima" />
                        <x-text-input id="jam_terima" name="jam_terima" type="time" class="mt-1.5 block w-full" :value="old('jam_terima', $suratMasuk->jam_terima ? \Carbon\Carbon::parse($suratMasuk->jam_terima)->format('H:i') : '')" />
                        <x-input-error :messages="$errors->get('jam_terima')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="keterangan" value="Keterangan" />
                        <x-text-input id="keterangan" name="keterangan" type="text" class="mt-1.5 block w-full" :value="old('keterangan', $suratMasuk->keterangan)" />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-5">
                    <x-input-label for="lampiran" value="Lampiran (PDF, maks. 2MB)" />
                    <input id="lampiran" name="lampiran" type="file" accept=".pdf" class="mt-1.5 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 cursor-pointer" />
                    @if($suratMasuk->lampiran)
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">File saat ini: <a href="{{ asset('storage/' . $suratMasuk->lampiran) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Lihat PDF</a></p>
                    @endif
                    <x-input-error :messages="$errors->get('lampiran')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="isi_ringkas" value="Isi Ringkas" />
                    <textarea id="isi_ringkas" name="isi_ringkas" rows="4" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">{{ old('isi_ringkas', $suratMasuk->isi_ringkas) }}</textarea>
                    <x-input-error :messages="$errors->get('isi_ringkas')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update
                    </button>
                    <a href="{{ route('surat-masuk.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
