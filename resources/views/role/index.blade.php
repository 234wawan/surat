<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Role Management</span>
            <a href="{{ route('role.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Role
            </a>
        </div>
    </x-slot>

    @php
        $menusData = $menus->map(fn($m) => [
            'id' => $m->id,
            'name' => $m->name,
            'section' => $m->section,
            'children' => $m->children->pluck('id')->toArray(),
        ])->toArray();
    @endphp

    <div x-data="roleManager()" x-init="allMenus = @json($menusData)" class="space-y-5">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">No</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Nama Role</th>
                            <th class="px-5 py-4 text-left font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Deskripsi</th>
                            <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Menu</th>
                            <th class="px-5 py-4 text-center font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">User</th>
                            <th class="px-5 py-4 text-right font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($roles as $role)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-5 py-4 whitespace-nowrap text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $role->name }}</span>
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">{{ $role->slug }}</span>
                                </td>
                                <td class="px-5 py-4 text-gray-500 max-w-xs truncate">{{ $role->description ?? '-' }}</td>
                                <td class="px-5 py-4 text-center">
                                    <button @click="openMenuPanel({{ $role->id }}, '{{ $role->name }}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/40 rounded-lg transition-colors cursor-pointer">
                                        <span x-text="roleMenuCounts[{{ $role->id }}] ?? {{ $role->menus_count }}">{{ $role->menus_count }}</span> menu
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </button>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300">{{ $role->users_count }} user</span>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('role.show', $role) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 rounded-lg transition-colors">Detail</a>
                                        <a href="{{ route('role.edit', $role) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-lg transition-colors">Edit</a>
                                        <form action="{{ route('role.destroy', $role) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">Belum ada role. Silakan tambah role baru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Slide-out Panel -->
        <div x-show="panelOpen" x-cloak class="fixed inset-0 z-50 overflow-hidden" @keydown.escape.window="closePanel()">
            <div class="absolute inset-0 bg-black/50" @click="closePanel()"></div>
            <div class="absolute inset-y-0 right-0 w-full max-w-2xl bg-white dark:bg-gray-800 shadow-xl transform transition-transform duration-300" :class="panelOpen ? 'translate-x-0' : 'translate-x-full'">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Akses Menu</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Role: <span x-text="panelRoleName" class="font-medium text-indigo-600 dark:text-indigo-400"></span></p>
                        </div>
                        <button @click="closePanel()" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
                        <template x-for="menu in allMenus" :key="menu.id">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-700/50">
                                    <div class="flex items-center gap-3">
                                        <button @click="toggleSection(menu.id, menu.children)" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none" :class="isSectionChecked(menu.id, menu.children) ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                            <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isSectionChecked(menu.id, menu.children) ? 'translate-x-4' : 'translate-x-0'"></span>
                                        </button>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white" x-text="menu.name"></span>
                                        <span x-show="menu.section" class="text-xs text-gray-500 dark:text-gray-400" x-text="'(' + menu.section + ')'"></span>
                                    </div>
                                    <span class="text-xs text-gray-400" x-text="getSectionCount(menu.id, menu.children) + ' / ' + (menu.children.length + 1)"></span>
                                </div>

                                <template x-if="menu.children.length > 0">
                                    <div class="px-4 py-2 space-y-1 bg-white dark:bg-gray-800">
                                        <template x-for="childId in menu.children" :key="childId">
                                            <div class="flex items-center gap-3 py-1.5">
                                                <button @click="toggleMenu(childId)" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none" :class="isMenuChecked(childId) ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600'">
                                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" :class="isMenuChecked(childId) ? 'translate-x-4' : 'translate-x-0'"></span>
                                                </button>
                                                <span class="text-sm text-gray-700 dark:text-gray-300" x-text="getMenuName(childId)"></span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <span x-text="panelMenuCount" class="font-semibold text-indigo-600 dark:text-indigo-400">0</span> menu diakses
                            </p>
                            <button @click="closePanel()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function roleManager() {
            return {
                allMenus: [],
                panelOpen: false,
                panelRoleId: null,
                panelRoleName: '',
                panelMenus: {},
                panelMenuCount: 0,
                roleMenuCounts: {},

                openMenuPanel(roleId, roleName) {
                    this.panelRoleId = roleId;
                    this.panelRoleName = roleName;
                    this.panelOpen = true;
                    document.body.style.overflow = 'hidden';

                    fetch(`/role/${roleId}/menus`)
                        .then(res => res.json())
                        .then(data => {
                            this.panelMenus = {};
                            data.menu_ids.forEach(id => { this.panelMenus[id] = true; });
                            this.panelMenuCount = data.menu_ids.length;
                        });
                },

                closePanel() {
                    this.panelOpen = false;
                    document.body.style.overflow = '';
                },

                toggleMenu(menuId) {
                    const newState = !this.panelMenus[menuId];
                    this.panelMenus[menuId] = newState;
                    this.panelMenuCount = Object.values(this.panelMenus).filter(v => v).length;

                    if (this.panelRoleId) {
                        this.roleMenuCounts[this.panelRoleId] = this.panelMenuCount;

                        fetch(`/role/${this.panelRoleId}/toggle-menu`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ menu_id: menuId }),
                        });
                    }
                },

                toggleSection(parentId, childIds) {
                    const allIds = [parentId, ...childIds];
                    const allChecked = allIds.every(id => this.panelMenus[id]);
                    const newState = !allChecked;

                    allIds.forEach(id => {
                        this.panelMenus[id] = newState;
                    });
                    this.panelMenuCount = Object.values(this.panelMenus).filter(v => v).length;

                    if (this.panelRoleId) {
                        this.roleMenuCounts[this.panelRoleId] = this.panelMenuCount;

                        fetch(`/role/${this.panelRoleId}/toggle-menus-bulk`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ menu_ids: allIds, active: newState }),
                        });
                    }
                },

                isMenuChecked(menuId) {
                    return this.panelMenus[menuId] || false;
                },

                isSectionChecked(parentId, childIds) {
                    const allIds = [parentId, ...childIds];
                    return allIds.length > 0 && allIds.every(id => this.panelMenus[id]);
                },

                getSectionCount(parentId, childIds) {
                    const allIds = [parentId, ...childIds];
                    return allIds.filter(id => this.panelMenus[id]).length;
                },

                getMenuName(menuId) {
                    for (const menu of this.allMenus) {
                        if (menu.id === menuId) return menu.name;
                        const child = menu.children.find(c => c.id === menuId);
                        if (child) return child.name;
                    }
                    return '';
                },
            };
        }
    </script>
    @endpush
</x-app-layout>
