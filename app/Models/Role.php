<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'permissions'];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission(string $permission): bool
    {
        $permissions = $this->normalizePermissions($this->effectivePermissions());

        if (in_array('*', $permissions, true)) {
            return true;
        }

        return in_array($permission, $permissions, true);
    }

    private function effectivePermissions(): array
    {
        // Prefer stored permissions; if empty/null, fall back to defaults based on role name
        $stored = $this->permissions;

        if (is_array($stored) && count($stored) > 0) {
            return $stored;
        }

        $defaults = config('permissions.defaults')[$this->name] ?? [];
        return $defaults;
    }

    private function normalizePermissions(array $perms): array
    {
        $map = [
            'deliveries' => 'eyeglass-orders',
            'delivery' => 'eyeglass-orders',
            'sales' => 'reports',
        ];

        $normalized = array_map(fn ($p) => $map[$p] ?? $p, $perms);

        return array_values(array_unique($normalized));
    }
}
