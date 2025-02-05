<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    Role::create(['name' => 'super-admin']);

    Role::create(['name' => 'user']);
    }
}
