<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; 

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        Role::whereIn('name', ['super-admin', 'admin', 'user'])->delete();
        Permission::whereIn('name', [
            'view', 'create', 'edit', 'delete',
        ])->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

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

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $users = User::all(); 
        foreach ($users as $user) {
            $user->syncRoles(['super-admin']); 
        }
    }
}
