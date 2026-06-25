@php
    $notifDisposisi = \App\Models\Disposisi::where('status', 'belum')
        ->where(function ($q) {
            $q->where('kepada', Auth::id())
              ->orWhereHas('penerimaLainnya', function ($r) {
                  $r->where('user_id', Auth::id());
              });
        })
        ->with('suratMasuk', 'pengirim')
        ->latest()
        ->take(10)
        ->get();
    $notifCount = $notifDisposisi->count();
@endphp
<header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex items-center justify-between h-full px-4 md:px-6">
        <div class="flex items-center gap-3">
            <button id="sidebarToggle" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="text-gray-300 dark:text-gray-600">/</span>
                <span class="font-medium text-gray-700 dark:text-gray-300">{{ request()->route()->uri() ?? 'Dashboard' }}</span>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative" id="notifContainer">
                <button id="notifButton" class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if($notifCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 inline-flex items-center justify-center text-[10px] font-bold text-white bg-red-500 rounded-full min-w-[18px] min-h-[18px] leading-none px-1">{{ $notifCount }}</span>
                    @endif
                </button>
                <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Disposisi Baru</p>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        @forelse($notifDisposisi as $d)
                            <a href="{{ route('disposisi.show', $d) }}" class="flex items-start gap-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-700/30 border-b border-gray-100 dark:border-gray-700/50 last:border-0">
                                <div class="w-2 h-2 mt-1.5 bg-red-500 rounded-full shrink-0"></div>
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $d->suratMasuk->perihal }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">dari {{ $d->pengirim->name }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada disposisi baru</div>
                        @endforelse
                    </div>
                    <a href="{{ route('disposisi.index') }}" class="block p-2 text-center text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700/30 rounded-b-xl">Lihat Semua</a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ Auth::user()->jabatan->nama ?? ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>
    </div>
</header>
