<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    public function created(User $user)
    {
        if (!Role::where('name', 'super-admin')->exists()) {
            Role::create(['name' => 'super-admin']);
        }

        $user->assignRole('super-admin');
    }
}
