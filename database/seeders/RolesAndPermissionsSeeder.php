<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Roles
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Assets
            'view assets',
            'create assets',
            'edit assets',
            'delete assets',
            
            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',
            
            // Licences
            'view licences',
            'create licences',
            'edit licences',
            'delete licences',
            
            // Barcode
            'view barcode',
            'create barcode',
            'scan barcode'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // SuperAdmin Role
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin Role
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all()->except(['view users', 'create users', 'edit users', 'delete users']));

        // User Role
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view assets',
            'view products',
            'view barcode',
            'scan barcode'
        ]);
    }
} 