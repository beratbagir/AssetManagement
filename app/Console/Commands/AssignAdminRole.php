<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    protected $signature = 'user:make-admin {userId}';
    protected $description = 'Assigns admin role to specified user';

    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found!");
            return;
        }

        $user->syncRoles([]);
        $user->assignRole('admin');

        $this->info("Admin role assigned to user: {$user->name}");
    }
} 