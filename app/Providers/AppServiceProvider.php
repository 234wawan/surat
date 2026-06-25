<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('crud-surat', function ($user) {
            return in_array($user->role, ['admin', 'staf']);
        });

        Gate::define('delete-surat', function ($user) {
            return in_array($user->role, ['admin', 'staf']);
        });

        Gate::define('crud-disposisi', function ($user) {
            return in_array($user->role, ['admin', 'staf', 'kabag']);
        });

        Gate::define('delete-disposisi', function ($user) {
            return $user->role === 'admin';
        });
    }
}
