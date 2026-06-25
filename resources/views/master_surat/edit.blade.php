<x-app-layout>
    <x-slot name="header">Edit Master Surat</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('master-surat.update', $masterSurat) }}" method="POST">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="kode" value="Kode" />
                        <x-text-input id="kode" name="kode" type="text" class="mt-1.5 block w-full" :value="old('kode', $masterSurat->kode)" required />
                        <x-input-error :messages="$errors->get('kode')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nama" value="Nama Surat" />
                        <x-text-input id="nama" name="nama" type="text" class="mt-1.5 block w-full" :value="old('nama', $masterSurat->nama)" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-5">
                    <x-input-label for="pola_nomor" value="Pola Nomor Surat" />
                    <x-text-input id="pola_nomor" name="pola_nomor" type="text" class="mt-1.5 block w-full" :value="old('pola_nomor', $masterSurat->pola_nomor)" />
                    <p class="mt-1 text-xs text-gray-400">Gunakan <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">{no}</code> untuk nomor urut, <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">{tahun}</code> untuk tahun, <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">{Romawi}</code> untuk bulan romawi</p>
                    <x-input-error :messages="$errors->get('pola_nomor')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="keterangan" value="Keterangan" />
                    <textarea id="keterangan" name="keterangan" rows="3" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">{{ old('keterangan', $masterSurat->keterangan) }}</textarea>
                    <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update
                    </button>
                    <a href="{{ route('master-surat.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
