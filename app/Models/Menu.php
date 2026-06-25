<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        'route',
        'url',
        'route_param',
        'order',
        'section',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function roles()
    {
        return $this->hasMany(\App\Models\MenuRole::class, 'menu_id');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public static function getMenusForRole(string $role)
    {
        return static::active()->root()
            ->whereHas('roles', fn($q) => $q->where('role', $role))
            ->with(['children' => function ($q) use ($role) {
                $q->active()->ordered()
                    ->whereHas('roles', fn($r) => $r->where('role', $role));
            }])
            ->orderBy('section')
            ->orderBy('order')
            ->get();
    }
}
