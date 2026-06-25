<x-app-layout>
    <x-slot name="header">Edit Surat Keluar</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('surat-keluar.update', $suratKeluar) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="master_surat_id" value="Jenis Surat" />
                        <select id="master_surat_id" name="master_surat_id" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">
                            <option value="">— Pilih jenis surat —</option>
                            @foreach($masterSurat as $ms)
                                <option value="{{ $ms->id }}" {{ old('master_surat_id', $suratKeluar->master_surat_id) == $ms->id ? 'selected' : '' }}>{{ $ms->kode }} — {{ $ms->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('master_surat_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="tanggal_surat" value="Tanggal Surat" />
                        <x-text-input id="tanggal_surat" name="tanggal_surat" type="date" class="mt-1.5 block w-full" :value="old('tanggal_surat', $suratKeluar->tanggal_surat->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('tanggal_surat')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-5">
                    <x-input-label for="no_surat" value="No Surat" />
                    <div class="mt-1.5 flex items-center gap-3">
                        <x-text-input id="no_surat" name="no_surat" type="text" class="block w-full" :value="old('no_surat', $suratKeluar->no_surat)" />
                        <x-text-input id="no_urut" name="no_urut" type="number" min="1" class="w-24 shrink-0" placeholder="No urut" :value="old('no_urut', $suratKeluar->no_urut)" title="Isi untuk skip/lompat nomor urut" />
                        <span id="preview_loading" class="hidden text-xs text-gray-400 shrink-0">Mengenerate...</span>
                    </div>
                    <p id="preview_info" class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">Nomor surat digenerate otomatis. Isi <b>No urut</b> manual untuk skip/lompat nomor.</p>
                    <x-input-error :messages="$errors->get('no_surat')" class="mt-2" />
                    <x-input-error :messages="$errors->get('no_urut')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="tujuan" value="Tujuan" />
                        <x-text-input id="tujuan" name="tujuan" type="text" class="mt-1.5 block w-full" :value="old('tujuan', $suratKeluar->tujuan)" required />
                        <x-input-error :messages="$errors->get('tujuan')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="perihal" value="Perihal" />
                        <x-text-input id="perihal" name="perihal" type="text" class="mt-1.5 block w-full" :value="old('perihal', $suratKeluar->perihal)" required />
                        <x-input-error :messages="$errors->get('perihal')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-5">
                    <x-input-label for="lampiran" value="Lampiran (PDF, maks. 2MB)" />
                    <input id="lampiran" name="lampiran" type="file" accept=".pdf" class="mt-1.5 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 cursor-pointer" />
                    @if($suratKeluar->lampiran)
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">File saat ini: <a href="{{ asset('storage/' . $suratKeluar->lampiran) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Lihat PDF</a></p>
                    @endif
                    <x-input-error :messages="$errors->get('lampiran')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="isi_ringkas" value="Isi Ringkas" />
                    <textarea id="isi_ringkas" name="isi_ringkas" rows="4" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">{{ old('isi_ringkas', $suratKeluar->isi_ringkas) }}</textarea>
                    <x-input-error :messages="$errors->get('isi_ringkas')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update
                    </button>
                    <a href="{{ route('surat-keluar.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const masterSurat = document.getElementById('master_surat_id');
        const tanggalSurat = document.getElementById('tanggal_surat');
        const noSurat = document.getElementById('no_surat');
        const noUrut = document.getElementById('no_urut');
        const previewInfo = document.getElementById('preview_info');
        const previewLoading = document.getElementById('preview_loading');

        function previewNomor() {
            const msId = masterSurat.value;
            const tgl = tanggalSurat.value;

            if (!msId || !tgl) {
                noSurat.value = '{{ $suratKeluar->no_surat }}';
                previewInfo.textContent = 'Kosongkan jenis surat untuk gunakan nomor lama.';
                previewInfo.className = 'mt-1.5 text-xs text-gray-400 dark:text-gray-500';
                return;
            }

            previewLoading.classList.remove('hidden');
            previewInfo.textContent = 'Mengenerate...';
            previewInfo.className = 'mt-1.5 text-xs text-gray-400 dark:text-gray-500';

            const payload = { master_surat_id: msId, tanggal_surat: tgl };
            if (noUrut.value) {
                payload.no_urut = parseInt(noUrut.value);
            }

            fetch('{{ route("surat-keluar.preview-nomor") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(r => r.json())
            .then(data => {
                noSurat.value = data.no_surat;
                noUrut.value = data.no_urut;
                previewLoading.classList.add('hidden');
                previewInfo.textContent = noUrut.value ? 'Nomor urut manual: ' + noUrut.value : 'Nomor urut otomatis: ' + data.no_urut;
                previewInfo.className = 'mt-1.5 text-xs text-green-600 dark:text-green-400';
            })
            .catch(() => {
                previewLoading.classList.add('hidden');
                previewInfo.textContent = 'Gagal generate nomor. Coba lagi.';
                previewInfo.className = 'mt-1.5 text-xs text-red-500';
            });
        }

        masterSurat.addEventListener('change', previewNomor);
        tanggalSurat.addEventListener('change', previewNomor);
        noUrut.addEventListener('change', previewNomor);
        noUrut.addEventListener('keyup', previewNomor);

    });
    </script>
    @endpush
</x-app-layout>
