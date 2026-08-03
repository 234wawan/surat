<x-app-layout>
    <x-slot name="header">Tambah Role</x-slot>

    @php
        $menusData = $menus->map(fn($m) => [
            'id' => $m->id,
            'name' => $m->name,
            'section' => $m->section,
            'children' => $m->children->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->toArray(),
        ])->toArray();
    @endphp

    <div class="max-w-4xl mx-auto" x-data="roleForm()" x-init="init()">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <x-input-label for="name" value="Nama Role" />
                        <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full" :value="old('name')" required placeholder="Contoh: Admin, Staf, Kabag" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="slug" value="Slug (ID Unik)" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1.5 block w-full" :value="old('slug')" required placeholder="Contoh: admin, staf, kabag" />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-6">
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea id="description" name="description" rows="3" class="mt-1.5 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm" placeholder="Deskripsi singkat tentang role ini...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <x-input-label value="Akses Menu" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pilih menu mana saja yang bisa diakses oleh role ini</p>
                        </div>
                        <button type="button" @click="toggleAll()" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors" :class="allChecked ? 'text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40' : 'text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:hover:bg-indigo-900/40'">
                            <span x-text="allChecked ? 'Batal Pilih Semua' : 'Pilih Semua'"></span>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <template x-for="menu in allMenus" :key="menu.id">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="toggleSection(menu.id, menu.children.map(c => c.id))" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" :class="isSectionChecked(menu.id, menu.children.map(c => c.id)) ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isSectionChecked(menu.id, menu.children.map(c => c.id)) ? 'translate-x-5' : 'translate-x-0'"></span>
                                        </button>
                                        <div>
                                            <span class="text-sm font-semibold text-gray-900 dark:text-white" x-text="menu.name"></span>
                                            <span x-show="menu.section" class="text-xs text-gray-500 dark:text-gray-400 ml-1" x-text="'(' + menu.section + ')'"></span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400" x-text="getSectionCount(menu.id, menu.children.map(c => c.id)) + ' / ' + (menu.children.length + 1)"></span>
                                </div>

                                <template x-if="menu.children.length > 0">
                                    <div class="px-4 py-2 space-y-1 bg-white dark:bg-gray-800">
                                        <template x-for="child in menu.children" :key="child.id">
                                            <div class="flex items-center gap-3 py-1.5">
                                                <button type="button" @click="toggleMenu(child.id)" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1" :class="isMenuChecked(child.id) ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isMenuChecked(child.id) ? 'translate-x-4' : 'translate-x-0'"></span>
                                                </button>
                                                <span class="text-sm text-gray-700 dark:text-gray-300" x-text="child.name"></span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-1">
                        <template x-for="menuId in selectedMenuIds" :key="menuId">
                            <input type="hidden" name="menus[]" :value="menuId" />
                        </template>
                    </div>
                    <x-input-error :messages="$errors->get('menus')" class="mt-2" />
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Simpan
                    </button>
                    <a href="{{ route('role.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function roleForm() {
            return {
                allMenus: @json($menusData),
                menus: {},
                allChecked: false,

                init() {
                    const oldMenus = @json(old('menus', []));
                    this.allMenus.forEach(menu => {
                        this.menus[menu.id] = oldMenus.includes(menu.id);
                        menu.children.forEach(child => {
                            this.menus[child.id] = oldMenus.includes(child.id);
                        });
                    });
                    this.updateAllChecked();
                },

                get selectedMenuIds() {
                    return Object.keys(this.menus).filter(id => this.menus[id]).map(Number);
                },

                toggleMenu(menuId) {
                    this.menus[menuId] = !this.menus[menuId];
                    this.updateAllChecked();
                },

                toggleSection(parentId, childIds) {
                    const allIds = [parentId, ...childIds];
                    const allChecked = allIds.every(id => this.menus[id]);
                    const newState = !allChecked;
                    allIds.forEach(id => { this.menus[id] = newState; });
                    this.updateAllChecked();
                },

                toggleAll() {
                    const newState = !this.allChecked;
                    Object.keys(this.menus).forEach(id => { this.menus[id] = newState; });
                    this.allChecked = newState;
                },

                isMenuChecked(menuId) {
                    return this.menus[menuId] || false;
                },

                isSectionChecked(parentId, childIds) {
                    const allIds = [parentId, ...childIds];
                    return allIds.length > 0 && allIds.every(id => this.menus[id]);
                },

                getSectionCount(parentId, childIds) {
                    return [parentId, ...childIds].filter(id => this.menus[id]).length;
                },

                updateAllChecked() {
                    this.allChecked = Object.values(this.menus).length > 0 && Object.values(this.menus).every(v => v);
                },
            };
        }

        document.getElementById('name').addEventListener('input', function() {
            const slug = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
    @endpush
</x-app-layout>
