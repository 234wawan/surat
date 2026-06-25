<x-app-layout>
    <x-slot name="header">Tambah Menu</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="name" value="Nama Menu" />
                        <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="parent_id" value="Menu Induk" />
                        <select id="parent_id" name="parent_id" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">
                            <option value="">— Tidak ada (menu utama) —</option>
                            @foreach($parentMenus as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="icon" value="Ikon (SVG path name)" />
                        <x-text-input id="icon" name="icon" type="text" class="mt-1.5 block w-full" :value="old('icon')" placeholder="Contoh: document-text" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="order" value="Urutan" />
                        <x-text-input id="order" name="order" type="number" class="mt-1.5 block w-full" :value="old('order', 0)" />
                        <x-input-error :messages="$errors->get('order')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="route" value="Route Name" />
                        <x-text-input id="route" name="route" type="text" class="mt-1.5 block w-full" :value="old('route')" placeholder="surat-masuk.index" />
                        <x-input-error :messages="$errors->get('route')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="route_param" value="Route Parameter" />
                        <x-text-input id="route_param" name="route_param" type="text" class="mt-1.5 block w-full" :value="old('route_param')" />
                        <x-input-error :messages="$errors->get('route_param')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="url" value="URL Langsung" />
                        <x-text-input id="url" name="url" type="text" class="mt-1.5 block w-full" :value="old('url')" placeholder="/halaman" />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="section" value="Section / Grup" />
                        <x-text-input id="section" name="section" type="text" class="mt-1.5 block w-full" :value="old('section')" placeholder="Menu Utama / Administrasi" />
                        <x-input-error :messages="$errors->get('section')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-5">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900" />
                        <span class="text-sm text-gray-700 dark:text-gray-300">Aktif</span>
                    </label>
                </div>

                <div class="mb-6">
                    <x-input-label value="Akses Role" />
                    <div class="mt-2 flex flex-wrap gap-4">
                        @foreach($roles as $role)
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="roles[]" value="{{ $role }}" {{ in_array($role, old('roles', ['admin', 'staf', 'kabag'])) ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900" />
                                <span class="text-sm text-gray-700 dark:text-gray-300 capitalize">{{ $role }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Simpan
                    </button>
                    <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
