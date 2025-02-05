<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    public function created(User $user)
    {
        if (User::count() === 1) {
            $user->assignRole('super-admin');
        } else {
            $user->assignRole('user');
        }
    }
} 