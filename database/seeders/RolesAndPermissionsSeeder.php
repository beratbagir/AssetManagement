<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Kullanıcı modelini dahil edin

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Önceden eklenmiş roller ve izinleri temizle
        Role::whereIn('name', ['super-admin', 'admin', 'user'])->delete();
        Permission::whereIn('name', [
            'view', 'create', 'edit', 'delete',
        ])->delete();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Users
            'view',
            'create',
            'edit',
            'delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // SuperAdmin Role
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Tüm kullanıcılara super-admin rolü ver
        $users = User::all(); // Tüm kullanıcıları al
        foreach ($users as $user) {
            $user->syncRoles(['super-admin']); // Her kullanıcıya super-admin rolünü ver
        }
    }
}
